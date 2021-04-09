<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 3/7/2019
 * Time: 4:11 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class AnketaOdgovori
{

    public $idOdg;
    public $idKorisnik;
    public $username;
    public $idAnketa;

    public function dohvatiSve(){
        return $upit = DB::table('anketa_odgovori')
            ->get();
    }

    public function dohvatiJedan(){
        return $upit = DB::table('anketa_odgovori')
            ->where('id_korisnik', '=', $this->idKorisnik)
            ->first();
    }

    public function insert(){
       return $upit=DB::table('anketa_odgovori')
            ->insert([
                'id_korisnik'=>$this->idKorisnik,
                'username'=>$this->username,
                'id_anketa'=>$this->idAnketa
            ]);
    }
}