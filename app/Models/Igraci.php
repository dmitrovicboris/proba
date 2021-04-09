<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2/26/2019
 * Time: 6:01 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Igraci
{
    public $id;
    public $ime;
    public $prezime;
    public $broj;
    public $pozicija;
    public $slika;
    public $alt;
    public $drzava;

    public function dohvatiSveIgrace() {

       return $upit = DB::table('igraci')
           ->paginate(4);
   }
    public function dohvatiSve2(){
        return $upit = DB::table('igraci')
            ->get();
    }
   public function unesiIgraca(){

        return $upit = DB::table('igraci')
            ->insert([
                'ime' => $this->ime,
                'prezime' => $this->prezime,
                'broj' => $this->broj,
                'pozicija' => $this->pozicija,
                'slika' => $this->slika,
                'alt' => $this->alt,
                'drzava' => $this->drzava
            ]);
   }

   public function izmeniIgraca(){
        $data = [
            'ime' => $this->ime,
            'prezime' => $this->prezime,
            'broj' => $this->broj,
            'pozicija' => $this->pozicija,
            'alt' => $this->alt,
            'drzava' => $this->drzava
        ];
        if(!empty($this->slika)){
            $data['slika'] = $this->slika;
        }
       return $upit = DB::table('igraci')
           ->where('id_igraci', '=', $this->id)
           ->update($data);
   }
   public function obrisiIgraca(){

        return $upit = DB::table('igraci')
            ->where('id_igraci', '=', $this->id)
            ->delete();
   }

    public function prikazJednogIgraca(){

        return $upit = DB::table('igraci')
            ->where('id_igraci', '=', $this->id)
            ->first();
    }

    public function search($unos){

        return $upit = DB::table('igraci')
            ->where('ime', 'like', '%' . $unos . '%')
            ->orWhere('prezime', 'like', '%' .$unos . '%')
            ->get();
    }
}