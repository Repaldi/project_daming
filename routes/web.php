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
Route::get('/getnamajasauser', 'EndUser\HomeController@getJasa');

Route::get('/download-rincian', 'EndUser\HomeController@downloadRincian');
Route::get('/getestimasiwaktuuser', 'EndUser\HomeController@getEstimasiWaktu');
Route::get('/search-data-waktu-pengerjaan', 'EndUser\HomeController@searchWaktuPengerjaan');



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
Route::get('/getjasa', 'Admin\HomeController@getJasa');
Route::get('/getdatajasa', 'Admin\HomeController@getDataJasa');

/*
|--------------------------------------------------------------------------
|Route Material
|--------------------------------------------------------------------------
*/

Route::get('/material', 'Admin\HomeController@material')->name('material');
Route::get('/material/tambah', 'Admin\HomeController@formMaterial')->name('formMaterial');
Route::post('/material/tambah/data-material', 'Admin\HomeController@tambahMaterial')->name('tambahMaterial');
Route::get('/material/edit/{id}', 'Admin\HomeController@editMaterial')->name('editMaterial');
Route::patch('/material/update/{id}', 'Admin\HomeController@updateMaterial')->name('updateMaterial');
Route::get('/material/delete/{id}', 'Admin\HomeController@deleteMaterial');

/*
|--------------------------------------------------------------------------
|Route Jasa
|--------------------------------------------------------------------------
*/

Route::get('/jasa', 'Admin\HomeController@jasa')->name('jasa');
Route::get('/jasa/tambah', 'Admin\HomeController@formJasa')->name('formJasa');
Route::post('/jasa/tambah/data-jasa', 'Admin\HomeController@tambahJasa')->name('tambahJasa');
Route::get('/jasa/edit/{id}', 'Admin\HomeController@editJasa')->name('editJasa');
Route::patch('/jasa/update/{id}', 'Admin\HomeController@updateJasa')->name('updateJasa');
Route::get('/jasa/delete/{id}', 'Admin\HomeController@deleteJasa');

/*
|--------------------------------------------------------------------------
|Route Tipe Bangunan
|--------------------------------------------------------------------------
*/

Route::get('/tipe-bangunan', 'Admin\HomeController@tipeBangunan')->name('tipeBangunan');
Route::get('/tipe-bangunan/tambah', 'Admin\HomeController@formTipeBangunan')->name('formTipeBangunan');
Route::post('/tipe-bangunan/tambah/data-tipe-bangunan', 'Admin\HomeController@tambahTipeBangunan')->name('tambahTipeBangunan');
Route::get('/tipe-bangunan/edit/{id}', 'Admin\HomeController@editTipeBangunan')->name('editTipeBangunan');
Route::patch('/tipe-bangunan/update/{id}', 'Admin\HomeController@updateTipeBangunan')->name('updateTipeBangunan');
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

/*
|--------------------------------------------------------------------------
|Route Estimasi Waktu
|--------------------------------------------------------------------------
*/

Route::get('/list-estimasi-waktu', 'Admin\HomeController@listEstimasiWaktu')->name('listEstimasiWaktu');
Route::get('/list-estimasi-waktu/tambah', 'Admin\HomeController@formEstimasiWaktu')->name('formEstimasiWaktu');
Route::post('/list-estimasi-waktu/tambah/data-estimasi-waktu', 'Admin\HomeController@addEstimasiWaktu')->name('addEstimasiWaktu');
Route::get('/list-estimasi-waktu/detail-estimasi-waktu/{id}', 'Admin\HomeController@formDetailEstimasiWaktu')->name('formDetailEstimasiWaktu');
Route::get('/list-estimasi-waktu/delete/{id}', 'Admin\HomeController@deleteEstimasiWaktu');

// Route::post('/keranjang', 'Admin\HomeController@keranjang');
// Route::post('/kalkulasi/keranjang_material', 'Admin\HomeController@keranjangMaterial');

Route::get('logout', function(){
    \Auth::logout();
    return redirect('/');
});