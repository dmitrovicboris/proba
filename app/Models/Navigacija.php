<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2/26/2019
 * Time: 4:50 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Navigacija
{
    public $id;
    public $naziv;
    public $href;

    public function dohvatiNavigacije(){
        return $upit = DB::table('navigacija')
            ->get();
    }
    public function unesiNavigaciju(){
        return $upit = DB::table('navigacija')
            ->insert([
               'id_navigacija' => $this->id,
               'naziv' => $this->naziv,
                'href' => $this->href
            ]);
    }
    public function izmeniNavigaciju(){

        return $upit = DB::table('navigacija')
            ->where('id_navigacija', '=', $this->id)
            ->update([
                'id_navigacija' => $this->id,
                'naziv' => $this->naziv,
                'href' => $this->href
            ]);
    }
    public function obrisiNavigaciju(){

        return $upit = DB::table('navigacija')
            ->where('id_navigacija', '=', $this->id)
            ->delete();
    }
}