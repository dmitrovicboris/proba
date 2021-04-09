<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2/26/2019
 * Time: 12:34 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Korisnik
{

    public $id;
    public $username;
    public $password;
    public $email;
    public $ulogaId;

    public  function dohvatiSve(){
        return $upit = DB::table('korisnik')
            ->get();
    }
    public function dohvatiJednog(){
        return $upit = DB::table('korisnik')
            ->where('id_korisnik', '=', $this->id)
            ->first()   ;
    }

        //logovanje
    public function uloguj(){

        return $upit = DB::table('korisnik')
            ->select('korisnik.*', 'uloga.*')
            ->join('uloga', 'uloga.id_uloga', '=', 'korisnik.id_uloga')
            ->where([
                'username' => $this->username,
                'password' => md5($this->password)
            ])
            ->first();
    }
        //registracija
    public function registruj(){
        return $upit = DB::table('korisnik')
              ->insert([
                  'username' => $this->username,
                  'password' => md5($this->password),
                  'email' => $this->email,
                  'id_uloga' => $this->ulogaId
                  ]);
    }
    public function izmenaKorisnika(){

        return $upit = DB::table('korisnik')
            ->where('id_korisnik', '=', $this->id)
            ->update([
                'username' => $this->username,
                'password' => md5($this->password),
                'email' => $this->email,
                'id_uloga' => $this->ulogaId
            ]);
    }

    public function brisanjeKorisnika(){

        return $upit = DB::table('korisnik')
            ->where('id_korisnik', '=', $this->id)
            ->delete();
    }
}