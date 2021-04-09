<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    //Pocetna i posebna vest
Route::get('/', 'FrontendController@index');
Route::get('/single/{id}', 'FrontendController@single');
    //AUTOR
Route::get('/autor', 'FrontendController@autor')->name('autor');
    //LOGOVANJE
Route::post('/logovanje', 'LoginController@login')->name('logovanje');
    //LOGOUT
Route::get('/logout', 'LoginController@logout')->name('logout');
    //registracija
Route::get('/registracija', 'RegistracijaController@prikazRegistracije');
Route::post('/registracija', 'RegistracijaController@registruj')->name('registracija');
    //GALERIJA
Route::get('/galerija', 'GalerijaController@index');
    //AJAX igraci
Route::get('/igraci', 'IgraciController@index')->name('igraci');
Route::get('igraci/search', 'IgraciController@search');
Route::post('igraci/search', 'IgraciController@search');
Route::get('igraci/{id}', 'IgraciController@show');
    //DOWNLOAD DOKUMENTACIJA
Route::get('/download', 'FrontendController@download')->name('dokumentacija');

    //AJAX ANKETA
Route::group(['prefix' => '/ajax'], function (){

     Route::get('/anketa', 'AnketaController@anketa' )->name('link');
     Route::post('/insert', 'AnketaController@storeAjax' )->name('storeAjax');
     Route::get('/result', 'AnketaController@show' )->name('go');
});
    //KONTAKT
Route::get('/kontakt/prikaz', 'KorisnikController@kontaktPrikaz')->name('kontakPrikaz');
Route::post('/kontakt/posalji', 'KorisnikController@kontaktPosalji')->name('kontaktPosalji');






    //ZASTICENE RUTE ZA ADMINA !!!!!
Route::group(['middleware'=> 'admin'],function (){

    //Ruta za prikaz strane AdminPanela
Route::get('/admin', 'VestiController@prikaz');

    //PRIKAZ ZA UNOS IGRACA I UNOS
Route::get('/igraciPrikaz', 'IgraciController@igraciPrikaz')->name('igraciPrikaz');
Route::post('/igraciUnos', 'IgraciController@igraciUnos')->name('igraciUnos');

    //GALERIJA
Route::get('/galerijaPrikaz', 'GalerijaController@prikaz')->name('galerijaPrikaz');
Route::post('/galerijaUnos', 'GalerijaController@insert')->name('galerijaUnos');

    //KORISNICI
Route::get('/admin/korisnik/view/{id?}','KorisnikController@listKorisnikView')->name('returnKorisnikView');
Route::get('/admin/korisnik/delete/{id}','KorisnikController@deleteKorisnik');
Route::post('admin/korisnik/update/{id}','KorisnikController@updateKorisnik');
Route::post('/admin/korisnik/save','KorisnikController@saveKorisnik');

    //VESTI
Route::get('/vestiPrikaz', 'VestiController@vestiPrikaz')->name('vestiPrikaz');
Route::get('/admin/deletePost/{id}','VestiController@adminPanelDeletePost');
Route::post('/admin/updatePost/{id}','VestiController@updatePost');
Route::post('/vestiUnos', 'VestiController@vestiUnos')->name('vestiUnos');
    //vraca delete view za postove, ova ruta vraca i getALl metod i getbyone{$id} metod PAZI
Route::get('/admin/deletePostView/{id?}','VestiController@adminPanelDeleteView')->name('PostDeleteView');

    //IGRACI
Route::get('/admin/igrac/view/{id?}', 'IgraciController@prikaz')->name('igraciAdminPrikaz');
Route::get('/admin/igrac/delete/{id}' , 'IgraciController@deleteIgrac' )->name('igracAdminDelete');
Route::post('/admin/igrac/update/{id}', 'IgraciController@updateIgrac')->name('igracAdminUpdate');
Route::post('/admin/igrac/insert', 'IgraciController@insertIgrac')->name('igracAdminUnos');

    //GALERIJA
Route::get('/admin/galerija/view/{id?}', 'GalerijaController@adminPrikaz')->name('galerijaAdminPrikaz');
Route::get('/admin/galerija/delete/{id}', 'GalerijaController@adminDelete')->name('galerijaAdminDelete');
Route::post('/admin/galerija/update/{id}', 'GalerijaController@adminUpdate')->name('galerijaAdminUpdate');
Route::post('/admin/galerija/insert', 'GalerijaController@adminInsert')->name('galerijaAdminInsert');

    //ULOGE
Route::get('/admin/uloge/view/{id?}', 'FrontendController@admin')->name('admin');
Route::get('/admin/uloge/delete/{id}', 'FrontendController@adminDelete')->name('ulogeAdminDelete');
Route::post('/admin/uloge/update/{id}', 'FrontendController@adminUpdate')->name('ulogeAdminUpdate');
Route::post('/admin/uloge/insert', 'FrontendController@adminInsert')->name('ulogeAdminInsert');

    //ANKETA
Route::get('/admin/anketa/view/{id?}', 'AnketaController@adminPrikaz')->name('anketeAdminPrikaz');
Route::post('/admin/anketa/update/{id}', 'AnketaController@adminUpdate' )->name('anketeAdminUpdate');
Route::post('/admin/anketa/insert', 'AnketaController@adminInsert')->name('anketeAdminInsert');
Route::get('/admin/anketa/delete/{id}', 'AnketaController@adminDelete')->name('anketeAdminDelete');

});
