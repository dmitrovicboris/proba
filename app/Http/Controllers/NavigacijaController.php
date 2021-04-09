<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigacija;

class NavigacijaController extends Controller
{
        private $data=[];

       public function __construct()
       {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();

       }
}
