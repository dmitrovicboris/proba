<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 3/7/2019
 * Time: 3:11 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Galerija
{
    public $id;
    public $slika;
    public $alt;

    public function dohvatiGaleriju(){
        return $upit = DB::table('galerija')
            ->paginate('4');
    }
    public function dohvatiGaleriju2(){
        return $upit = DB::table('galerija')
            ->get();
    }
    public function insert(){
        return $upit = DB::table('galerija')
            ->insert([
               'slika' => $this->slika,
               'alt' => $this->alt
            ]);
    }
    public function update(){
        $data = [
            'alt' => $this->alt
        ];
        if(!empty($this->slika)){
            $data['slika'] = $this->slika;
        }
        return $upit = DB::table('galerija')
            ->where('id_galerija', '=', $this->id )
            ->update($data);
    }

    public function delete(){
        return $upit = DB::table('galerija')
            ->where('id_galerija', '=', $this->id )
            ->delete();
    }
    public function dohvatiJednuGaleriju(){
        return $upit = DB::table('galerija')
            ->where('id_galerija', '=', $this->id )
            ->first();
    }
}