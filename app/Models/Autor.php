<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 2/26/2019
 * Time: 5:01 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Autor
{
    public $id;
    public $naslov;
    public $opis;
    public $slika;

    public function dohvatiAutora(){
        return $upit = DB::table('autor')
            ->where([
                'id_autor' => $this->id
            ])
            ->get();
    }
}