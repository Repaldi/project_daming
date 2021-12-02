<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\TipeBangunan;
use App\Kalkulasi;
use App\KalkulasiDetail;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        
        $provinsi = Provinsi::all();
        $data_kalkulasi = Kalkulasi::where('provinsi_id', 'Random');
        return view('welcome',compact(['provinsi','data_kalkulasi']));
    }

    public function getKabupaten(Request $request){
    
        $kabupaten = Kabupaten::where("provinsi_id",$request->provinsi_id)->pluck('id','nama_kabupaten');
    
        return response()->json($kabupaten);
    }
    
    public function getKecamatan(Request $request){
    
        $kecamatan = Kecamatan::where("kabupaten_id",$request->kabupaten_id)->pluck('id','nama_kecamatan');
        return response()->json($kecamatan);
    }

    public function getTipeBangunan(Request $request){
        $tipebangunan = TipeBangunan::where("kecamatan_id",$request->kecamatan_id)->pluck('id','nama_tipe_bangunan');
        return response()->json($tipebangunan);
    }

    public function searchDataKalkulasi(Request $request){
       $data_kalkulasi = DB::table('kalkulasi')->where([
                                                    ['provinsi_id',  '=', $request->provinsi_id],
                                                    ['kabupaten_id', '=', $request->kabupaten_id],
                                                    ['kecamatan_id', '=', $request->kecamatan_id],
                                                    ['tipe_bangunan_id', '=', $request->tipebangunan_id],
                                                ])->pluck('total_harga')->first();
                                   
        return response()->json($data_kalkulasi);
    }

    public function searchJasaId(Request $request){
       $data_jasa_id = DB::table('jasa')->where([
                                            ['provinsi_id',  '=', $request->provinsi_id],
                                            ['kabupaten_id', '=', $request->kabupaten_id],
                                            ['kecamatan_id', '=', $request->kecamatan_id],
                                        ])->pluck('id','nama_jasa');;
                                   
        return response()->json($data_jasa_id);
    }

    public function getJasa(Request $request){
       $data_jasa = DB::table('jasa')->where([
                                            ['provinsi_id',  '=', $request->provinsi_id],
                                            ['kabupaten_id', '=', $request->kabupaten_id],
                                            ['kecamatan_id', '=', $request->kecamatan_id],
                                        ])->pluck('nama_jasa','harga_jasa');;
                                   
        return response()->json($data_jasa);
    }
}
