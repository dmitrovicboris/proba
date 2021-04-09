<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 3/9/2019
 * Time: 6:29 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Uloge
{
    public $id;
    public $naziv;

    public function getAll(){
       return $upit = DB::table('uloga')
           ->get();
    }

    public function getUlogaById(){
        $upit=DB::table('uloga')
            ->where('id_uloga','=', $this->id)
            ->first();
        return $upit;
    }
    public function update(){

        $upit=DB::table('uloga')
            ->where('id_uloga','=', $this->id)
            ->update([
                'naziv'=>$this->naziv
            ]);
        return $upit;
    }
    public function insert(){
        $upit=DB::table('uloga')
            ->insert([
                'naziv'=>$this->naziv
            ]);
        return $upit;
    }
    public function delete(){
        $upit=DB::table('uloga')
            ->where('id_uloga','=', $this->id)
            ->delete();
        return $upit;
    }
}