<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'EndUser\HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
|Route Khusus End User
|Route Get Data JSON
|--------------------------------------------------------------------------
*/
Route::get('/getkabupatenuser', 'EndUser\HomeController@getKabupaten');
Route::get('/getkecamatanuser', 'EndUser\HomeController@getKecamatan');
Route::get('/gettipebangunanuser', 'EndUser\HomeController@getTipeBangunan');
Route::get('/search-data-kalkulasi', 'EndUser\HomeController@searchDataKalkulasi');
Route::get('/search-data-nama-jasa', 'EndUser\HomeController@searchJasaId');
Route::get('/getnamajasa', 'EndUser\HomeController@getJasa');



/*
|--------------------------------------------------------------------------
|Route Get Data JSON
|--------------------------------------------------------------------------
*/

Route::get('/getkabupaten', 'Admin\HomeController@getKabupaten');
Route::get('/getkecamatan', 'Admin\HomeController@getKecamatan');
Route::get('/gettipebangunan', 'Admin\HomeController@getTipeBangunan');
Route::get('/getmaterial', 'Admin\HomeController@getMaterial');
Route::get('/gethargamaterial', 'Admin\HomeController@getHargaMaterial');
Route::get('/getnamamaterial', 'Admin\HomeController@getNamaMaterial');

/*
|--------------------------------------------------------------------------
|Route Material
|--------------------------------------------------------------------------
*/

Route::get('/material', 'Admin\HomeController@material')->name('material');
Route::post('/material/tambah-material', 'Admin\HomeController@tambahMaterial')->name('tambahMaterial');
Route::get('/material/delete/{id}', 'Admin\HomeController@deleteMaterial');

/*
|--------------------------------------------------------------------------
|Route Jasa
|--------------------------------------------------------------------------
*/

Route::get('/jasa', 'Admin\HomeController@jasa')->name('jasa');
Route::post('/jasa/tambah-jasa', 'Admin\HomeController@tambahJasa')->name('tambahJasa');
Route::get('/jasa/delete/{id}', 'Admin\HomeController@deleteJasa');

/*
|--------------------------------------------------------------------------
|Route Tipe Bangunan
|--------------------------------------------------------------------------
*/

Route::get('/tipe-bangunan', 'Admin\HomeController@tipeBangunan')->name('tipeBangunan');
Route::post('/tipe-bangunan/tambah-tipe-bangunan', 'Admin\HomeController@tambahTipeBangunan')->name('tambahTipeBangunan');
Route::get('/tipe-bangunan/delete/{id}', 'Admin\HomeController@deleteTipeBangunan');

/*
|--------------------------------------------------------------------------
|Route Kalkulasi
|--------------------------------------------------------------------------
*/

Route::get('/list-kalkulasi', 'Admin\HomeController@listKalkulasi')->name('listKalkulasi');
Route::get('/list-kalkulasi/tambah', 'Admin\HomeController@formKalkulasi')->name('formKalkulasi');
Route::post('/list-kalkulasi/tambah/data-kalkulasi', 'Admin\HomeController@addKalkulasi')->name('addKalkulasi');
Route::get('/list-kalkulasi/detail-kalkulasi/{id}', 'Admin\HomeController@formDetailKalkulasi')->name('formDetailKalkulasi');
Route::get('/list-kalkulasi/delete/{id}', 'Admin\HomeController@deleteKalkulasi');

// Route::post('/keranjang', 'Admin\HomeController@keranjang');
// Route::post('/kalkulasi/keranjang_material', 'Admin\HomeController@keranjangMaterial');

Route::get('logout', function(){
    \Auth::logout();
    return redirect('/');
});