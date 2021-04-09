<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Korisnik;

class LoginController extends Controller
{
    public function login(Request $request){

        try {
            $korisnik = new Korisnik();
            $korisnik->username = $request->input('username');
            $korisnik->password = $request->input('pass');
            $rez = $korisnik->uloguj();

            if($rez) {
                $request->session()->put('korisnik', $rez);

                if (session()->get('korisnik')->naziv == 'admin')
                    return redirect('/admin');
                else return redirect('/')->with('uspesno', 'USPESNO STE SE LOGOVALI');
            }
            else return redirect()->back()->with('neuspesno', 'NEUSPESNO LOGOVANJE!');

        }
        catch (\Exception $e) {
            \Log::critical('GRESKA : '. $e->getMessage());

        }
    }

    public function logout(Request $request){
        $request->session()->forget('korisnik');
        $request->session()->flush();
        return redirect('/');
    }

}
