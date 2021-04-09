<?php

namespace App\Http\Controllers;

use App\Http\Requests\VestiInsertRequest;
use App\Http\Requests\VestiRequest;
use App\Models\Navigacija;
use App\Models\Uloge;
use App\Models\Vesti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VestiController extends Controller
{
    private $data = [];

    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();
    }




    public function vestiPrikaz()
    {
        return view('pages.kreirajVest', $this->data);
    }

    public function vestiUnos(VestiInsertRequest $request)
    {


        $slika = $request->file('slika');
        $ekstenzija = $slika->getClientOriginalExtension();
        $tmp_putanja = $slika->getPathname();

        $foler = "images/";
        $ime_fajla = time().".".$ekstenzija;
        $nova_putanja = public_path($foler) . $ime_fajla;


        try {
        File::move($tmp_putanja, $nova_putanja);

        $vest = new Vesti();
        $vest->naslov = $request->input('naslov');
        $vest->tekst = $request->input('tekst');
        $vest->slika = $foler.$ime_fajla;
        $vest->alt = $request->input('alt');
        $vest->idKorisnik = session()->get('korisnik')->id_korisnik;
       $vest->kreiran = date('H:i:s Y-m-d');


        $rez = $vest->unesiVest();

            return redirect()->back()->with('uspeh','USPESNO!');}
        catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }
    }
    public function prikaz(){
        $uloge = new Uloge();
        $this->data['uloge'] = $uloge->getAll();
        return view('pages.adminPanel', $this->data);
    }

    public function adminPanelDeleteView($id = null){
        $vest = new Vesti();
        $this->data['adminPanelPostsDelete'] = $vest->dohvatiSve2();
        if($id){
            $vest->id = $id;
            $this->data['adminPanelPostDelete'] = $vest->dohvatiJedan();
        }
            return view('pages.adminVesti', $this->data);
        }
    public function adminPanelDeletePost($id){
        $vest = new Vesti();
        $vest->id = $id;

        $korisnik_to_update = $vest->dohvatiJedan();
        File::delete($korisnik_to_update->slika);
        try{
        $rez = $vest->obrisiVest();

            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

    }
    public function updatePost($id, VestiRequest $request){

        $vest = new Vesti();
        $vest->id= $id;

        $vest->naslov = $request->input('naslov');
        $vest->tekst = $request->input('tekst');
        $vest->alt = $request->input('alt');
        $vest->slika = $request->file('slika');
        $vest->izmenjen = date('H:i:s Y-m-d');


        $vest->idKorisnik = session()->get('korisnik')->id_korisnik;

        if(!empty($slika)){

            $selected = $vest->dohvatiJedan();
            File::delete($selected->slika);
            $slika = $request->file('slika');
            $tmp_putanja = $slika->getPathname();
            $ime_fajla = time().".".$slika->getClientOriginalExtension();
            $putanja = "images/".$ime_fajla;
            $putanja_server = public_path($putanja);

            File::move($tmp_putanja,$putanja_server);

            $vest->slika = $putanja;
         }
            try{
        $rez = $vest->izmeniVest();

          return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }
    }



}