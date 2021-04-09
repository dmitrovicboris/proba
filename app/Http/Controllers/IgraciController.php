<?php

namespace App\Http\Controllers;

use App\Http\Requests\IgraciInsertRequest;
use App\Http\Requests\IgraciRequest;
use App\Models\Vesti;
use Illuminate\Http\Request;
use App\Models\Igraci;
use App\Models\Navigacija;
use \Psy\Util\Json;
use Illuminate\Support\Facades\File;

class IgraciController extends Controller
{
    private $data = [];

    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();
    }
        //AJAX SVE
     public function index(){
        try{
        $igrac = new Igraci();
        $igraci = $igrac->dohvatiSveIgrace();
        $this->data["igraci"] = $igraci;
           return view('pages.igraci', $this->data);
        //return response($igraci, 200);
        }
        catch (\Exception $e){
            \Log::error('Greska : ' . $e->getMessage());
            return response(null,500);
        }
    }
        //AJAX SERACH
    public function search(Request $request){
        try{
        $unos = $request->input('search');
        $igrac = new Igraci();
        $igraci = $igrac->search($unos);
            //return $igraci;
        if($igraci) return $igraci;
        else return redirect()->back()->with('nemaIgraca', 'NE POSTOJI IGRAČ SA TAKVIM IMENOM ILI PREZIMENOM!');
        }
        catch (\Exception $e){
            \Log::error("GRESKA : " . $e->getMessage());

        }
    }
    //AJAX PEIKAZ JEDNOG
    public function show($id){
        $igrac = new Igraci();
        $this->data['igraci'] = $igrac->prikazJednogIgraca();

        return view('pages.igraci', $this->data);
    }

    public function igraciPrikaz(){

        return view('pages.adminKreirajIgraca', $this->data);
    }

    public function insertIgrac(IgraciInsertRequest $request){

        $slika = $request->file('slika');
        $ekstenzija = $slika->getClientOriginalExtension();
        $tmp_putanja = $slika->getPathname();

        $folder = "images/";
        $ime_fajla = time().".".$ekstenzija;
        $nova_putanja = public_path($folder).$ime_fajla;

        try {
            File::move($tmp_putanja, $nova_putanja);

            $igrac = new Igraci();
            $igrac->ime = $request->input('ime');
            $igrac->prezime = $request->input('prezime');
            $igrac->broj = $request->input('broj');
            $igrac->pozicija = $request->input('pozicija');
            $igrac->drzava = $request->input('drzava');
            $igrac->alt = $request->input('alt');
            $igrac->slika = $folder.$ime_fajla;

            $igrac->unesiIgraca();
            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }
       // catch (\Sympfony\Component\HttpFoundation\File\Exception\FileException $e){
          //  \Log::error('Greška u radu sa fajlom' . $e->getMessage());
          //  return redirect()->back()->with('greskaFajl', 'Greška pri unosu slike!');
       // }
    }

    public function prikaz($id = null){
        $igrac = new Igraci();
        $this->data['igraci'] = $igrac->dohvatiSve2();
        if($id){
            $igrac->id= $id;
            $this->data['igrac'] = $igrac->prikazJednogIgraca();

        }

        return view('pages.adminIgraci', $this->data);
    }
    public function deleteIgrac($id){
        $igrac = new Igraci();
        $igrac->id= $id;

        $igrac_to_delete = $igrac->prikazJednogIgraca();
        File::delete($igrac_to_delete->slika);

        try{
        $rez = $igrac->obrisiIgraca();

            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

    }
     public function updateIgrac($id, IgraciRequest $request){
        $igrac = new Igraci();
        $igrac->id = $id;

            $igrac->ime = $request->input('ime');
             $igrac->prezime = $request->input('prezime');
             $igrac->broj = $request->input('broj');
             $igrac->pozicija = $request->input('pozicija');
             $igrac->drzava = $request->input('drzava');
             $igrac->alt = $request->input('alt');
             $slika = $request->file('slika');

            if(!empty($slika)){

            $selected = $igrac->prikazJednogIgraca();
            File::delete($selected->slika);
            $slika=$request->file('slika');
            $tmp_putanja = $slika->getPathname();
            $ime_fajla = time()."." .$slika->getClientOriginalExtension();
            $putanja = 'images/'.$ime_fajla;
            $putanja_server = public_path($putanja);

            File::move($tmp_putanja, $putanja_server);
            $igrac->slika = $putanja;

            }
            try{
            $rez = $igrac->izmeniIgraca();


             return redirect()->back()->with('uspeh','USPESNO!');
         }
         catch (\Exception $e) {
             \Log::error('GRESKA : ' .$e);
             return redirect()->back()->with('neuspeh','NEUSPESNO!');
         }

    }

}
