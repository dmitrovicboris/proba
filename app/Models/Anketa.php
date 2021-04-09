<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 3/7/2019
 * Time: 4:03 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Anketa
{
    public $id;
    public $naziv;
    public $rezulatat;

    public function dohvatiSve(){
        return $upit = DB::table('anketa')
            ->get();
    }

    public function dohvatiJedan(){
        return $upit = DB::table('anketa')
            ->where('id_anketa', '=', $this->id)
            ->first();
    }
    public function insert(){
        return $upit = DB::table('anketa')
            ->where('id_anketa', '=', $this->id)
            ->insert([
                'naziv'=>$this->naziv,
                'rezultat' => 0
            ]);
    }

    public function update(){
        $data = [
            'naziv' =>$this->naziv
        ];
        if(!empty($this->rezulatat)){
            $data['rezultat'] = $this->rezulatat;
        }
        else {
            $data['rezultat'] = 0;
        }
        return $upit = DB::table('anketa')
            ->where('id_anketa', '=', $this->id)
            ->update($data);
    }

    public function delete(){
        return $upit = DB::table('anketa')
            ->where('id_anketa', '=', $this->id)
            ->delete();
    }

    public function updateRez(){

        return $upit = DB::update('UPDATE anketa SET rezultat = rezultat + 1 where id_anketa=' .$this->id);
    }

}