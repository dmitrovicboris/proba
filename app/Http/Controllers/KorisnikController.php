<?php

namespace App\Http\Controllers;

use App\Http\Requests\KontaktRequest;
use App\Http\Requests\KorisnikAdminRequest;
use App\Http\Requests\RegistracijaNoviRequest;
use App\Models\Korisnik;
use App\Models\Uloge;
use Illuminate\Http\Request;
use App\Models\Navigacija;
use Illuminate\Support\Facades\Mail;


class KorisnikController extends Controller
{
    private  $data = [];
   public function __construct()
   {
       $nav = new Navigacija();
       $this->data['navigacija'] = $nav->dohvatiNavigacije();
       $uloga = new Uloge();
       $this->data['uloge'] = $uloga->getAll();
   }
   public  function listKorisnikView($id = null){

       $korisnik = new Korisnik();
       $this->data['listajKorisnika'] = $korisnik->dohvatiSve();
       if($id) {
           $korisnik->id = $id;
           $this->data['korisnikOne'] = $korisnik->dohvatiJednog();
       }
       return view('pages.adminKorisnik', $this->data);
   }

   public function updateKorisnik($id, KorisnikAdminRequest $request){

       try {
       $korisnik = new Korisnik();
       $korisnik->username = $request->input('username');
       $korisnik->password = $request->input('passwprd');
       $korisnik->email = $request->input('email');
       $korisnik->ulogaId = $request->input('ddlUloga');
        $korisnik->id = $id;
       $rez = $korisnik->izmenaKorisnika();

           return redirect()->back()->with('uspehKorisnik', 'USPEŠNO!');
       }
       catch (\Exception $e) {
           \Log::error('GREKSA : ' .$e);
           return redirect()->back()->with('neuspehKorisnik', 'NEUSPEŠNO!');
       }
}

    public function deleteKorisnik($id){
         $korisnik = new Korisnik();
         $korisnik->id = $id;
            try {
                $rez = $korisnik->brisanjeKorisnika();

                return redirect()->back()->with('uspehKorisnik', 'USPEŠNO!');
            }
         catch (\Exception $e) {
             return redirect()->back()->with('neuspehKorisnik', 'NEUSPEŠNO!');
             \Log::error('GRESKA : ' .$e);
            }
    }

    public function saveKorisnik(KorisnikAdminRequest $request){

       try{
        $korisnik = new Korisnik();
           $korisnik->username = $request->input('username');
           $korisnik->password = $request->input('passwprd');
           $korisnik->email = $request->input('email');
           $korisnik->ulogaId = $request->input('ddlUloga');
            $rez = $korisnik->registruj();

             return redirect()->back()->with('uspehKorisnik', 'USPEŠNO!');


       }catch (\Exception $e)
       {
            \Log::error("GRESKA : " .$e->getMessage());
           return redirect()->back()->with('neuspehKorisnik', 'NEUSPEŠNO!');
       }
    }
    public function kontaktPrikaz(){

       return view('pages.kontakt', $this->data);
    }
    public function kontaktPosalji(KontaktRequest $request){

       try {
           $r = new KontaktRequest();
           $this->data['request'] = (object) $r->all();

           $sent = Mail::send('email', $this->data, function($message){
               $message->to('boris.dmitrovic.ajax@gmail.com', 'Boris')->subject('Kontakt korisnika');
           });

//           $data = array(
//               'ime' => $request->input('ime'),
//               'poruka' => $request->input('poruka'),
//               'email' => $request->input('email')
//           );
//           Mail::to('boris.dmitrovic.ajax@gmail.com')->send(new SendMail($data));
//           return redirect()->back()->with('uspesanKontakt', 'USPEŠNO STE NAS KONTAKTIRALI!');
       }catch (\Exception $e){
          \Log::error(" NEUSPAN KONTAKT : " .$e->getMessage());
           return redirect()->back()->with('NEuspesanKontakt', 'NEUSPEŠNO!');
       }
       }
}
