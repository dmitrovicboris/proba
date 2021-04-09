<?php

namespace App\Http\Controllers;

use App\Http\Requests\UlogeRequest;
use App\Models\Uloge;
use Illuminate\Http\Request;
use App\Models\Vesti;
use App\Models\Navigacija;
use App\Models\Autor;
use Illuminate\Http\Response;

class FrontendController extends Controller
{

    private $data = [];

    public function __construct()
    {
        $nav = new Navigacija();
        $this->data['navigacija'] = $nav->dohvatiNavigacije();
    }

    public function index(){
       $vest = new Vesti();
       $this->data['vesti'] = $vest->dohvatiSve();
        return view('pages.home', $this->data);
    }
    public function single($id){
        if($id != null){
        $vest = new Vesti();
        $vest->id = $id;
        $this->data['singleVest'] = $vest->dohvatiJedan();
      }
        return view('pages.singleVest', $this->data);
    }
    public function autor(Request $request){
        $autor = new Autor();
        $autor->id=1;
        $this->data['autor'] = $autor->dohvatiAutora();
        $this->data['autor1'] = $this->data['autor'][0];
        return view('pages.autor', $this->data);

    }
        //DOWNLOAD DOKUMENTACIJA
    public function download(){
        try {
            $headers = array(
                'Content-Type : application/pdf',
            );
            return \response()->download(public_path('dokumentacija.pdf'), 'dokumentacija.pdf', $headers);
        }catch (\Exception $e) {

            \Log::error('GRESKA : ' . $e);
            return redirect()->back()->with('neuspesno','NEUSPESNO!');

        }       }

    public function admin($id = null)
    {   $uloga = new Uloge();
        $this->data['uloge'] = $uloga->getAll();
        if($id)
        {
            $uloga->id = $id;
            $this->data['uloga'] = $uloga->getUlogaById();
        }
        return view('pages.adminPanel', $this->data);
    }
   public function adminDelete($id){

      try{  $uloga = new Uloge();
        $uloga->id = $id;
        $rez = $uloga->delete();

           return redirect()->back()->with('uspeh','USPESNO!');
       }
       catch (\Exception $e) {
          \Log::error('GRESKA : ' .$e);
           return redirect()->back()->with('neuspeh','NEUSPESNO!');
       }
    }
    public function adminUpdate($id, UlogeRequest $request){
        try{
        $uloga = new Uloge();
        $uloga->id = $id;
        $uloga->naziv = $request->input('naziv');
        $rez = $uloga->update();

            return redirect()->back()->with('uspeh','USPESNO!');
        }
        catch (\Exception $e) {
            \Log::error('GRESKA : ' .$e);
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }
    }

    public function adminInsert(UlogeRequest $request){

        try{
            $uloga = new Uloge();
            $uloga->naziv = $request->input('naziv');

            $uloga->insert();
            return redirect()->back()->with('uspeh','USPESNO!');

        }catch (\Exception $e){
            \Log::error("GRESKA : " . $e->getMessage());
            return redirect()->back()->with('neuspeh','NEUSPESNO!');
        }

    }

    public function kontakPrikaz(){
        return view('pages.kontakt', $this->data);
    }
}
