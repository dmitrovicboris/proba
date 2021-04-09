<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2/17/2019
 * Time: 9:36 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Vesti
{
    public $id;
    public $naslov;
    public $tekst;
    public $kreiran;
    public $izmenjen;
    public $slika;
    public $alt;
    public $idKorisnik;

        //svi
    public function dohvatiSve(){

        return $upit = DB::table('vesti')
            ->orderBy('kreiran', 'desc')
            ->paginate(2);

    }
    public function dohvatiSve2(){
        return $upit = DB::table('vesti')
          ->get();
    }
        //jedan
    public function dohvatiJedan(){

        return $upit = DB::table('vesti')
            ->where('id_vesti', '=', $this->id)
            ->first();
    }
        //unos
    public function unesiVest(){

        return $upit = DB::table('vesti')
            ->insert([
               'naslov' => $this->naslov,
               'tekst' => $this->tekst,
               'kreiran' => $this->kreiran,
               'slika' => $this->slika,
               'alt' => $this->alt,
               'id_korisnik' => $this->idKorisnik
            ]);
    }
        //izmena
    public function izmeniVest(){
        $data = [
            'naslov' => $this->naslov,
            'tekst' => $this->tekst,
            'izmenjen' => $this->izmenjen,
            'alt' => $this->alt,
            'id_korisnik' => $this->idKorisnik
        ];
        if(!empty($this->slika)){
            $data['slika'] = $this->slika;
        }
        return $upit = DB::table('vesti')
            ->where('id_vesti', '=', $this->id)
            ->update($data);
    }
            //brisanje
    public function obrisiVest(){

        return $upit = DB::table('vesti')
            ->where('id_vesti', '=', $this->id)
            ->delete();
    }

}