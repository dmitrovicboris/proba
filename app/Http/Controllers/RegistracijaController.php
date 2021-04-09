<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistracijaNoviRequest;
use Illuminate\Http\Request;
use App\Models\Korisnik;
use App\Models\Navigacija;

class RegistracijaController extends Controller
{
    private $data = [];
    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();

    }
    public function prikazRegistracije(){

        return view('pages.registracija', $this->data);
    }
    public function registruj(RegistracijaNoviRequest $request){

        try {
            $korisnik = new Korisnik();
            $korisnik->username = $request->input('username');
            $korisnik->password = $request->input('password');
            $korisnik->email = $request->input('email');
            $korisnik->ulogaId = 2;

             $korisnik->registruj();

              return redirect()->back()->with('uspesnoReg', 'USPESNO STE SE REGISTROVALI!');


        }
        catch (\Exception $e) {
            \Log::error('GRESKA REGISTRACIJA : ' . $e->getMessage());
            return redirect()->back()->with('neuspesnoReg', "NEUSPENA REGISTRACIJA!");
        }

    }


}
