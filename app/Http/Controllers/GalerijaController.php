<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalerijaInsertRequest;
use App\Http\Requests\GalerijaRequest;
use Illuminate\Http\Request;
use App\Models\Navigacija;
use App\Models\Galerija;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Exception;

class GalerijaController extends Controller
{
    private $data = [];
    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();

    }
    public function index(){
        $slika = new Galerija();
        $this->data['galerija'] = $slika->dohvatiGaleriju();
        return view('pages.galerija', $this->data);
    }
    public function prikaz(){
        return view('pages.adminUnosGalerija', $this->data);
    }
    public function adminInsert(GalerijaInsertRequest $request){
        $slika = $request->file('slika');
        $ekstenzija = $slika->getClientOriginalExtension();
        $tmp_putanja = $slika->getPathname();

        $folder = "images/";
        $ime_fajla = time().".".$ekstenzija;
        $nova_putanja = public_path($folder).$ime_fajla;

        try{
            File::move($tmp_putanja, $nova_putanja);
            $slika = new Galerija();
            $slika->alt = $request->input('alt');
            $slika->slika = $folder.$ime_fajla;

            $slika->insert();
            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

   }
    public function adminPrikaz($id = null){

        $galerija = new Galerija();
        $this->data['galerije'] = $galerija->dohvatiGaleriju2();

        if($id) {
            $galerija->id = $id;
            $this->data['galerija'] = $galerija->dohvatiJednuGaleriju();
        }
    return view('pages.adminGalerija', $this->data);

    }
    public function adminUpdate($id, GalerijaRequest $request){
        $galerija = new Galerija();
        $galerija->id = $id;
        $galerija->alt = $request->input('alt');
        $slika = $request->file('slika');

        if(!empty($slika)){

            //brisanje stare slike sa servera
            $selected = $galerija->dohvatiJednuGaleriju();
            File::delete($selected->slika);


            //upload nove slike
            $tmp_putanja = $slika->getPathname();
            $ime_fajla = time().".".$slika->getClientOriginalExtension();
            $putanja = "images/".$ime_fajla;
            $putanja_sever = public_path($putanja);

            File::move($tmp_putanja, $putanja_sever);
            $galerija->slika = $putanja;
         }
        try{
        $rez = $galerija->update();


            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

    }
    public function adminDelete($id){

        $galerija = new Galerija();
        $galerija->id = $id;

        $galerija_to_delete = $galerija->dohvatiJednuGaleriju();
        File::delete($galerija_to_delete->slika);

        try{
        $rez = $galerija->delete();

        return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

    }




}
