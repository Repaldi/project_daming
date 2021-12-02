<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;
use App\Jasa;
use App\TipeBangunan;
use App\Kalkulasi;
use App\KalkulasiDetail;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use DB;


class HomeController extends Controller
{
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
    public function getMaterial(Request $request){
        $material = Material::where("kecamatan_id",$request->kecamatan_id)->pluck('id','nama_material');
        return response()->json($material);
    }

    public function getHargaMaterial(Request $request){
        $harga_material = Material::where("id",$request->material_id)->pluck('satuan_material','harga_material');
        return response()->json($harga_material);
    }

    public function getNamaMaterial(Request $request){
        $nama_material = Material::where("id",$request->material_id)->pluck('id','nama_material');
        return response()->json($nama_material);
    }

   

    public function addKalkulasi(Request $request){

 
    $kalkulasi = new kalkulasi;
    $kalkulasi->kode_kalkulasi = $request->kode_kalkulasi_hidden;
    $kalkulasi->provinsi_id = $request->provinsi_id_hidden;
    $kalkulasi->kabupaten_id = $request->kabupaten_id_hidden;
    $kalkulasi->kecamatan_id = $request->kecamatan_id_hidden;
    $kalkulasi->tipe_bangunan_id = $request->tipe_bangunan_id_hidden;
    $kalkulasi->total_material = $request->total_material_hidden;
    $kalkulasi->total_harga = $request->total_hidden;
    $kalkulasi->save();  
    $material_id = $_POST['material_id_hidden'];
    foreach ($material_id as $key => $material) {
        $data['kalkulasi_id'] = $kalkulasi->id;
        $data['material_id'] = $material;
        $data['satuan_material'] = $request->satuan_material_hidden[$key];
        $data['banyak_material'] = $request->banyak_material_hidden[$key];
        $data['sub_harga_material'] = $request->sub_harga_hidden[$key];
        KalkulasiDetail::create($data);
    }
    return redirect()->route('listKalkulasi');

    }

    public function material()
    {
        
        $material = Material::all();
        $provinsi = Provinsi::all();

        return view('dashboard.material',compact(['material','provinsi']));
    }
   
    
    public function tambahMaterial(Request $request)
    {  
        try {
          
            $material = material::create([
              'nama_material' => $request->nama_material,
              'harga_material' => $request->harga_material,
              'satuan_material' => $request->satuan_material,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->kabupaten_id,       
              'kecamatan_id' => $request->kecamatan_id,       
            ]);  
          
            return redirect()->back()->with('success-add-material','Text'); 
          } catch (\Exception $e) {
            return redirect()->back()->with('error-add-material','Text'); 
          }
    }

    public function deleteMaterial($id){
        Material::find($id)->delete();
        return redirect()->back()->with('success-delete-material','Text');
    }

    public function jasa()
    {
        
        $jasa = Jasa::all();
        $provinsi = Provinsi::all();

        return view('dashboard.jasa',compact(['jasa','provinsi']));
    }
   

    public function tambahJasa(Request $request)
    {  
        try {
          
            $jasa = Jasa::create([
              'nama_jasa' => $request->nama_jasa,
              'harga_jasa' => $request->harga_jasa,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->kabupaten_id,       
              'kecamatan_id' => $request->kecamatan_id,       
            ]);  
          
            return redirect()->back()->with('success-add-jasa','Text'); 
          } catch (\Exception $e) {
            return redirect()->back()->with('error-add-jasa','Text'); 
          }
    }
    
    public function deleteJasa($id){
        Jasa::find($id)->delete();
        return redirect()->back()->with('success-delete-jasa','Text');
    }

   
    public function tipeBangunan()
    {
        
        $tipeBangunan = TipeBangunan::all();
        $provinsi = Provinsi::all();

        return view('dashboard.tipe-bangunan',compact(['tipeBangunan','provinsi']));
    }
   

    public function tambahTipeBangunan(Request $request)
    {  
        try {
          
            $tipeBangunan = TipeBangunan::create([
              'nama_tipe_bangunan' => $request->nama_tipe_bangunan,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->kabupaten_id,       
              'kecamatan_id' => $request->kecamatan_id,       
            ]);  
          
            return redirect()->back()->with('success-add-tipe-bangunan','Text'); 
          } catch (\Exception $e) {
            return redirect()->back()->with('error-add-tipe-bangunan','Text'); 
          }
    }

    public function deleteTipeBangunan($id){
        TipeBangunan::find($id)->delete();
        return redirect()->back()->with('success-delete-tipe-bangunan','Text');
    }


    public function listKalkulasi()
    {
        $kalkulasi = Kalkulasi::all();
        
        return view('dashboard.list-kalkulasi',compact(['kalkulasi']));
    }
    public function formkalkulasi()
    {
        
        $provinsi = Provinsi::all();
     
        $id_terakhir = Kalkulasi::max('kode_kalkulasi');
        
        return view('dashboard.tambah-kalkulasi',compact(['provinsi','id_terakhir']));
    }

    public function formDetailKalkulasi($id){
        $kalkulasi = Kalkulasi::find($id);
        $detail_kalkulasi = KalkulasiDetail::where('kalkulasi_id', $id)->get();
        return view('dashboard.detail-kalkulasi', compact(['kalkulasi','detail_kalkulasi']));
    }

    public function deleteKalkulasi($id){
        $kalkulasi = Kalkulasi::find($id);
        $detail_kalkulasi = KalkulasiDetail::where('kalkulasi_id', $kalkulasi->id)->delete();
        $kalkulasi->delete();
        return redirect()->back()->with('success-delete-kalkulasi','Text');
    }


    // public function tambahKalkulasi(Request $request)
    // {  

    //     $material_id = $_POST['material_id'];
    //     $banyak_material = $_POST['banyak_material'];
    //     $harga_material = Material::all('harga_material');


    //     $no = 1;
    //     $noUrutAkhir = DB::table('kalkulasi')->max('sampel_ke');   
    //     if($noUrutAkhir) {
            
    //         foreach ($material_id as $key => $material){
    //             $data_material = Material::find($material);
    //             $data['sampel_ke'] = $noUrutAkhir+1;
    //             $data['provinsi_id'] = $request->provinsi_id;
    //             $data['kabupaten_id'] = $request->kabupaten_id;
    //             $data['kecamatan_id'] = $request->kecamatan_id;
    //             $data['tipe_bangunan_id'] = $request->tipe_bangunan_id;
    //             $data['material_id'] = $material;
    //             $data['satuan_material'] = $data_material->satuan_material; 
    //             $data['banyak_material'] = $banyak_material[$key];
    //             $data['sub_harga_material'] = $data_material->harga_material * $banyak_material[$key];
    
               
    //             Kalkulasi::create($data); 
                
    //         }
    //     }
    //     else {
    //         foreach ($material_id as $key => $material){
    //             $data_material = Material::find($material);
    //             $data['sampel_ke'] = $no;
    //             $data['provinsi_id'] = $request->provinsi_id;
    //             $data['kabupaten_id'] = $request->kabupaten_id;
    //             $data['kecamatan_id'] = $request->kecamatan_id;
    //             $data['tipe_bangunan_id'] = $request->tipe_bangunan_id;
    //             $data['material_id'] = $material;
    //             $data['satuan_material'] = $data_material->satuan_material; 
    //             $data['banyak_material'] = $banyak_material[$key];
    //             $data['sub_harga_material'] = $data_material->harga_material * $banyak_material[$key];
    
               
    //             Kalkulasi::create($data); 
                
    //         }
         
    //     }

     
    
        // $datakalkulasi = collect(['material_id' => $_POST['material_id'] , 'banyak_material' =>$_POST['banyak_material']]);
        // $datakalkulasi = array_combine($_POST['material_id'],$_POST['banyak_material']);
        // dd($datakalkulasi);
        
       
        // $data_kalkulasi = Kalkulasi::all('sampel_ke');
       
        // foreach ($material_id as $key => $material){
          
        //     $data['kalkulasi_id'] = $material;
        //     $data['satuan_material'] = $data_material->satuan_material; 
        //     $data['banyak_material'] = $banyak_material[$key];
        //     $data['sub_harga_material'] = $data_material->harga_material * $banyak_material[$key];
        //     Kalkulasi::create($data); 
        // }
}
