<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnketaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Anketa;
use App\Models\AnketaOdgovori;
use App\Models\Navigacija;

class AnketaController extends Controller
{
    private $data = [];
    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();
    }

    public function anketa(){
        try{
            $anketa = new Anketa();
            $ankete = $anketa->dohvatiSve();
            return response($ankete, 200);
        }
        catch (\Exception $e){
        \Log::error('GRESKA : ' .$e->getMessage());
        return response(null, 500);
        }

    }

    public function storeAjax(Request $request){
       try {
           $anketa = new AnketaOdgovori();
           $anketa->idKorisnik = session()->get('korisnik')->id_korisnik;
           $anketa->username = session()->get('korisnik')->username;
           $anketa->idAnketa = $request->input('anketa');
           $anketa->insert();

           $ank = new Anketa();
           $ank->id = $request->input('anketa');
           $ank->rezulatat = $request->input('rez');
           $ank->updateRez();

           return redirect('/ajax/result')->with('anketaUspeh', 'USPEŠNO STE GLASALI!');
       }
       catch (\Exception $e) {
           \Log::error("GRESKA : " .$e->getMessage());
           return redirect()->back()->with('anketaNeuspeh', 'GREŠKA PRI GLASANJU!');
       }

    }
    public function show(){
     $anketa = new Anketa();
     $ank = new AnketaOdgovori();
     $this->data['rezultati'] = $anketa->dohvatiSve();
     $this->data['users'] = $ank->dohvatiSve();
     $ank->idKorisnik  = session()->get('korisnik')->id_korisnik;

     $this->data['zabrana'] = $ank->dohvatiJedan();
     return view('pages.anketa ', $this->data);

    }
    public function adminPrikaz($id = null){
        $anketa = new Anketa();
        $this->data['ankete'] = $anketa->dohvatiSve();
        if($id){
            $anketa->id = $id;
            $this->data['anketa'] = $anketa->dohvatiJedan();
        }
        return view('pages.adminAnketa', $this->data);
    }
    public function adminUpdate($id, Request $request){

        try {
            $anketa = new Anketa();
            $anketa->id = $id;
            $anketa->naziv = $request->input('naziv');
            $anketa->rezulatat = $request->input('rez');

            $anketa->update();
            return redirect()->back()->with('uspeh','USPESNO!');

        }catch (\Exception $e){
            \Log::error("GRESKA : " .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }
    }
    public function adminInsert(AnketaRequest $request){

      try {
          $anketa = new Anketa();
          $anketa->naziv = $request->input('naziv');
          $anketa->rezulatat = $request->input('rez');

          $anketa->insert();
          return redirect()->back()->with('uspeh','USPESNO!');
      }
      catch (\Exception $e){
          \Log::error("GRESKA : " .$e);
          return redirect()->back()->with('neuspeh','NEUSPESNO!');
      }

    }
    public function adminDelete($id){
       try {
           $anketa = new Anketa();
           $anketa->id = $id;
           $anketa->delete();
           return redirect()->back()->with('uspeh','USPESNO!');
       }
       catch (\Exception $e){
           \Log::error("GRESKA : " .$e);
           return redirect()->back()->with('neuspeh','NEUSPESNO!');
       }
    }

}
