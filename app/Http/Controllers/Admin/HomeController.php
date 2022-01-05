<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;
use App\Jasa;
use App\TipeBangunan;
use App\Kalkulasi;
use App\KalkulasiDetail;
use App\EstimasiWaktu;
use App\EstimasiWaktuDetail;
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

    public function getJasa(Request $request){
        $data_jasa_id =Jasa::where("kecamatan_id", $request->kecamatan_id)->pluck('id','nama_jasa');   
         return response()->json($data_jasa_id);
     }

     public function getDataJasa(Request $request){
        $data_jasa = Jasa::where("id",$request->jasa_id)->pluck('nama_jasa','harga_jasa');
                                    
         return response()->json($data_jasa);
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

    public function addEstimasiWaktu(Request $request){

 
        $estimasi_waktu = new EstimasiWaktu;
        $estimasi_waktu->provinsi_id = $request->provinsi_id_hidden;
        $estimasi_waktu->kabupaten_id = $request->kabupaten_id_hidden;
        $estimasi_waktu->kecamatan_id = $request->kecamatan_id_hidden;
        $estimasi_waktu->total_jasa = $request->total_jasa_hidden;
        $estimasi_waktu->total_harga_jasa = $request->total_hidden;
        $estimasi_waktu->waktu_pengerjaan = $request->waktu_pengerjaan_hidden;
        $estimasi_waktu->save();  
        $jasa_id = $_POST['jasa_id_hidden'];
        foreach ($jasa_id as $key => $jasa) {
            $data['estimasi_waktu_id'] = $estimasi_waktu->id;
            $data['jasa_id'] = $jasa;
            $data['harga_jasa'] = $request->harga_jasa_hidden[$key];
            $data['jumlah_jasa'] = $request->jumlah_jasa_hidden[$key];
            $data['sub_harga_jasa'] = $request->sub_harga_hidden[$key];
            EstimasiWaktuDetail::create($data);
        }
        return redirect()->route('listEstimasiWaktu');
    
        }

    public function material()
    {
        
        $material = Material::paginate(5);

        return view('dashboard.list-material',compact(['material']));
    }

    public function formMaterial()
    {       
        $provinsi = Provinsi::all();
        return view('dashboard.tambah-material',compact(['provinsi']));
    }
   
    
    public function tambahMaterial(Request $request)
    {  

          
            $material = material::create([
              'nama_material' => $request->nama_material,
              'harga_material' => $request->harga_material,
              'satuan_material' => $request->satuan_material,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->filled('kabupaten_id')? $request->kabupaten_id : Null,      
              'kecamatan_id' => $request->filled('kecamatan_id')? $request->kecamatan_id : Null,       
            ]);  
          
            return redirect()->route('material')->with('success-add-material','Text'); 
         
    }
    
    public function editMaterial($id)
    {  
        $material = Material::find($id);
        $provinsi = Provinsi::all();
        
        return view('dashboard.edit-material',compact(['material','provinsi']));
    }

    public function updateMaterial(Request $request)
    {  
         $material = Material::findOrFail($request->id);
         $material->update($request->all());
         return redirect()->route('material');
    }
    

    public function deleteMaterial($id){
        Material::find($id)->delete();
        return redirect()->back()->with('success-delete-material','Text');
    }

    public function jasa()
    {    
        $jasa = Jasa::paginate(5);
        return view('dashboard.list-jasa',compact(['jasa']));
    }

    public function formJasa()
    {      
        $provinsi = Provinsi::all();
        return view('dashboard.tambah-jasa',compact(['provinsi']));
    }
   

    public function tambahJasa(Request $request)
    {  
       
      
            $jasa = Jasa::create([
              'nama_jasa' => $request->nama_jasa,
              'harga_jasa' => $request->harga_jasa,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->filled('kabupaten_id')? $request->kabupaten_id : Null,      
              'kecamatan_id' => $request->filled('kecamatan_id')? $request->kecamatan_id : Null,          
            ]);  
          
            return redirect()->route('jasa')->with('success-add-jasa','Text'); 
         
    }

    public function editJasa($id)
    {  
        $jasa = Jasa::find($id);
        $provinsi = Provinsi::all();
        
        return view('dashboard.edit-jasa',compact(['jasa','provinsi']));
    }

    public function updateJasa(Request $request)
    {  
         $jasa = Jasa::findOrFail($request->id);
         $jasa->update($request->all());
         return redirect()->route('jasa');
    }
    
    public function deleteJasa($id){
        Jasa::find($id)->delete();
        return redirect()->back()->with('success-delete-jasa','Text');
    }

   
    public function tipeBangunan()
    {
        
        $tipeBangunan = TipeBangunan::paginate(5);

        return view('dashboard.list-tipe-bangunan',compact(['tipeBangunan']));
    }

    public function formTipeBangunan()
    {       
        $provinsi = Provinsi::all();
        return view('dashboard.tambah-tipe-bangunan',compact(['provinsi']));
    }
   

    public function tambahTipeBangunan(Request $request)
    {  
      
          
            $tipeBangunan = TipeBangunan::create([
              'nama_tipe_bangunan' => $request->nama_tipe_bangunan,
              'provinsi_id' => $request->provinsi_id,
              'kabupaten_id' => $request->filled('kabupaten_id')? $request->kabupaten_id : Null,      
              'kecamatan_id' => $request->filled('kecamatan_id')? $request->kecamatan_id : Null,        
            ]);  
          
            return redirect()->route('tipeBangunan')->with('success-add-tipe-bangunan','Text'); 
        
    }

    public function editTipeBangunan($id)
    {  
        $tipe_bangunan= TipeBangunan::find($id);
        $provinsi = Provinsi::all();
        
        return view('dashboard.edit-tipe-bangunan',compact(['tipe_bangunan','provinsi']));
    }

    public function updateTipeBangunan(Request $request)
    {  
         $tipe_bangunan = TipeBangunan::findOrFail($request->id);
         $tipe_bangunan->update($request->all());
         return redirect()->route('tipeBangunan');
    }
    


    public function deleteTipeBangunan($id){
        TipeBangunan::find($id)->delete();
        return redirect()->back()->with('success-delete-tipe-bangunan','Text');
    }


    public function listKalkulasi()
    {
        $kalkulasi = Kalkulasi::paginate(5);
        
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

    public function listEstimasiWaktu()
    {
        $estimasi_waktu = EstimasiWaktu::paginate(5);
        
        return view('dashboard.list-estimasi-waktu',compact(['estimasi_waktu']));
    }

    public function formEstimasiWaktu()
    {
        
        $provinsi = Provinsi::all();
        return view('dashboard.tambah-estimasi-waktu',compact(['provinsi']));
    }

    public function deleteEstimasiWaktu($id){
        $estimasi_waktu = EstimasiWaktu::find($id);
        $detail_estimasi_waktu = EstimasiWaktuDetail::where('estimasi_waktu_id', $estimasi_waktu->id)->delete();
        $estimasi_waktu->delete();
        return redirect()->back()->with('success-delete-estimasi-waktu','Text');
    }

    public function formDetailEstimasiWaktu($id){
        $estimasi_waktu = EstimasiWaktu::find($id);
        $detail_estimasi_waktu = EstimasiWaktuDetail::where('estimasi_waktu_id', $id)->get();
        return view('dashboard.detail-estimasi-waktu', compact(['estimasi_waktu','detail_estimasi_waktu']));
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
