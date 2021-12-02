@extends('layouts.master-dashboard')
@section('content')

<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Kalkulasi</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="dashboard.html#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Kalkulasi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
   
<div class="container-fluid mt--6">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                  <div class="col-10">
                  <h3 class="mb-0">Tambah Data Kalkulasi </h3>
                  </div>
                  <div class="col-2">
                  <a href="{{route('listKalkulasi')}}" type="button" class="btn btn-primary btn-block"><i class="fa fa-reply"></i> Kembali</a>  
                  </div>
              </div>
            </div>
            
            <div class="card-body" id="content" >
           
                <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-provinsi">Kode</label>
                          <input type="text"  value="<?php echo $id_terakhir+1; ?>" class="form-control" name="kode_kalkulasi"  readonly>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                          <label class="form-control-label" for="input-provinsi">Provinsi</label>
                          <select class="form-control" name="provinsi_id" id="provinsi">
                              <option disabled selected>Pilih Provinsi</option>
                              @foreach($provinsi as $data_provinsi)
                              <option value="{{$data_provinsi->id}}">{{$data_provinsi->nama_provinsi}}</option>
                              @endforeach    
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                          <label class="form-control-label" for="input-kabupaten">Kabupaten</label>
                          <select class="form-control" name="kabupaten_id" id="kabupaten">
                              <option selected>Pilih Kabupaten</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                          <label class="form-control-label" for="input-kecamatan">Kecamatan</label>
                          <select class="form-control" name="kecamatan_id" id="kecamatan">
                              <option selected>Pilih Kecamatan</option>
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-tipebangunan">Tipe Bangunan</label>
                          <select class="form-control" name="tipe_bangunan_id" id="tipebangunan">
                              <option selected>Pilih Tipe Bangunan</option>
                          </select>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                          <label class="form-control-label" for="input-material">Nama Material</label>
                          <select class="form-control" value="" name="material_id" id="material">
                              <option selected>Pilih Material</option>
                          </select>
                      </div>
                    </div>         
                    <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-material">Harga Material</label>
                          <input type="hidden"  class="form-control" name="nama_material" id="nama_material">
                          <input type="hidden"  class="form-control" name="satuan_material" id="satuan_material" >
                          <input type="text"  class="form-control" name="harga_material" id="harga_material" readonly>
                        
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                          <label class="form-control-label" for="input-material">Qty</label>
                          <input type="number" readonly class="form-control" name="banyak_material"  id="banyak_material" min='1' >
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                          <label class="form-control-label" for="input-material">Sub Harga</label>
                          <input type="text"  class="form-control" name="sub_harga" id="sub_harga" readonly>
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>                      
                        </div>
                    </div>
                </div>

             
                <hr class="my-4" />
                <form action="{{route('addKalkulasi')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row keranjang">
                  <div class="col-lg-12">
                    <table class="table table-bordered" id="keranjang">
                      <thead>
                        <tr>
                          <td width="35%">Nama Material</td>
                          <td width="15%">Harga</td>
                          <td width="15%">Jumlah</td>
                          <td width="10%">Satuan</td>
                          <td width="10%">Sub Total</td>
                          <td width="15%">Aksi</td>
                        </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                      <tfoot>
												<tr>
													<td colspan="4" align="right"><strong>Total : </strong></td>
													<td id="total"></td>
													
													<td>
														<input type="hidden" name="kode_kalkulasi_hidden" value="">
														<input type="hidden" name="provinsi_id_hidden" value="">
														<input type="hidden" name="kabupaten_id_hidden" value="">
														<input type="hidden" name="kecamatan_id_hidden" value="">
														<input type="hidden" name="tipe_bangunan_id_hidden" value="">
														<input type="hidden" name="total_material_hidden" value="">
														<input type="hidden" name="total_hidden" value="">
														<button  type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
                    </table>
                  </div>
                </div>
                </form>
                
                
            </div> 
            <!-- <div class="col-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</a>
            </div> -->
            
           
          </div>
        </div>
      </div> 
</div>
 
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('kalkulasi.js')}}"></script>


@endsection



