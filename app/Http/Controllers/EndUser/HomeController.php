<?php

namespace App\Http\Controllers\EndUser;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\Request;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\TipeBangunan;
use App\EstimasiWaktu;
use App\EstimasiWaktuDetail;
use App\Jasa;
use App\Kalkulasi;
use App\KalkulasiDetail;

use DB;

class HomeController extends Controller
{
    public function index()
    {
        
        $provinsi = Provinsi::all();
        return view('welcome',compact(['provinsi']));
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

    public function getEstimasiWaktu(Request $request){
        $estimasi_waktu = EstimasiWaktu::where('id', $request->estimasi_waktu_id)->get();
        // $detail_estimasi_waktu = EstimasiWaktuDetail::where('estimasi_waktu_id',  $request->estimasi_waktu_id)->get();
        $detail_estimasi_waktu = EstimasiWaktuDetail::join('jasa',function ($join){
            $join->on('estimasi_waktu_detail.jasa_id','=', 'jasa.id');
        })->where('estimasi_waktu_detail.estimasi_waktu_id', $request->estimasi_waktu_id)->get();
        return response()->json(['estimasi_waktu' => $estimasi_waktu, 'detail_estimasi_waktu' => $detail_estimasi_waktu]);
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

    public function downloadRincian(Request $request){
       $data_rincian_kalkulasi = DB::table('kalkulasi')->where([
                                                    ['provinsi_id',  '=', $request->provinsi_id],
                                                    ['kabupaten_id', '=', $request->kabupaten_id],
                                                    ['kecamatan_id', '=', $request->kecamatan_id],
                                                    ['tipe_bangunan_id', '=', $request->tipebangunan_id],
                                                ])->first();
        
        
        $detail_rincian_kalkulasi= KalkulasiDetail::join('kalkulasi',function ($join){
        $join->on('kalkulasi_detail.kalkulasi_id','=', 'kalkulasi.id');
        })->where('kalkulasi_detail.kalkulasi_id', $data_rincian_kalkulasi->id)->get();

       $data_rincian_estimasi_waktu = DB::table('estimasi_waktu')->where([
                                                    ['provinsi_id',  '=', $request->provinsi_id],
                                                    ['kabupaten_id', '=', $request->kabupaten_id],
                                                    ['kecamatan_id', '=', $request->kecamatan_id],
                                                ])->first();
        
        $detail_rincian_estimasi_waktu= EstimasiWaktuDetail::join('estimasi_waktu',function ($join){
        $join->on('estimasi_waktu_detail.estimasi_waktu_id','=', 'estimasi_waktu.id');
        })->where('estimasi_waktu_detail.estimasi_waktu_id', $data_rincian_estimasi_waktu->id)->get();

                                            
        $pdf = PDF::loadview('data_rincian_pdf',['data_rincian_kalkulasi'=>$data_rincian_kalkulasi,
                                                 'detail_rincian_kalkulasi'=>$detail_rincian_kalkulasi,
                                                 'data_rincian_estimasi_waktu'=>$data_rincian_estimasi_waktu,
                                                 'detail_rincian_estimasi_waktu'=>$detail_rincian_estimasi_waktu
                                                ]);
        return $pdf->download('data_rincian_pdf');
  
    }

    public function searchJasaId(Request $request){
       $data_jasa_id = DB::table('jasa')->where([
                                            ['provinsi_id',  '=', $request->provinsi_id],
                                            ['kabupaten_id', '=', $request->kabupaten_id],
                                            ['kecamatan_id', '=', $request->kecamatan_id],
                                        ])->pluck('id','nama_jasa');;
                                   
        return response()->json($data_jasa_id);
    }

    public function searchWaktuPengerjaan(Request $request){
       $data_waktu_pengerjaan = DB::table('estimasi_waktu')->where([
                                            ['provinsi_id',  '=', $request->provinsi_id],
                                            ['kabupaten_id', '=', $request->kabupaten_id],
                                            ['kecamatan_id', '=', $request->kecamatan_id],
                                        ])->pluck('id','waktu_pengerjaan');;
                                   
        return response()->json($data_waktu_pengerjaan);
    }

    public function getJasa(Request $request){
       $data_jasa = Jasa::where("id",$request->jasa_id)->pluck('nama_jasa','harga_jasa');
                                   
        return response()->json($data_jasa);
    }
}
