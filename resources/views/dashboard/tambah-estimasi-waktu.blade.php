@extends('layouts.master-dashboard')
@section('content')

<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Estimasi Waktu</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="dashboard.html#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Estimasi Waktu</li>
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
                  <div class="col-lg-10">
                    <h3 class="mb-0">Tambah Data Estimasi Waktu</h3>
                  </div>
                  <div class="col-lg-2 text-right">
                    <a href="{{route('listEstimasiWaktu')}}" type="button" class="btn btn-primary "><i class="fa fa-reply"></i> Kembali</a>  
                  </div>
                </div>
            </div>

                <div class="card-body" id="content" >

                <div class="row">

                  <div class="col-lg-3">
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

                  <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-kabupaten">Kabupaten</label>
                          <select class="form-control" name="kabupaten_id" id="kabupaten">
                              <option selected>Pilih Kabupaten</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-kecamatan">Kecamatan</label>
                          <select class="form-control" name="kecamatan_id" id="kecamatan">
                              <option selected>Pilih Kecamatan</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-3">
                      <div class="form-group">
                          <label class="form-control-label" for="input-estimasi-waktu">Estimasi Waktu</label>
                          <select class="form-control" name="waktu_pengerjaan" id="waktu_pengerjaan">
                              <option selected>Pilih Estimasi Waktu</option>
                              <option value="2">2 Minggu</option>
                              <option value="3">3 Minggu</option>
                              <option value="4">1 Bulan</option>
                          </select>
                      </div>
                  </div>

                </div>
           
                <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-jasa">Pilih Jasa</label>

                                <select class="form-control" name="jasa_id" id="jasa">
                                    <option selected>Pilih Jasa </option>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-harga-jasa">Harga</label>
                                <input type="text"  class="form-control" name="harga_jasa" id="harga_jasa" readonly>    
                                <input type="hidden"  class="form-control" name="nama_jasa" id="nama_jasa">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">

                                <label class="form-control-label" for="input-jumlah">Jumlah</label>
                                <input type="number" readonly class="form-control" name="jumlah_jasa"  id="jumlah_jasa" min='1' >
            
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-sub-harga">Sub Harga</label>
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
                
                </div> 

                <hr class="my-4" />
                <form action="{{route('addEstimasiWaktu')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row keranjang">
                  <div class="col-lg-12">
                    <table class="table table-bordered" id="keranjang">
                      <thead>
                        <tr>
                          <td width="35%">Nama Jasa</td>
                          <td width="15%">Harga</td>
                          <td width="15%">Jumlah</td>
                          <td width="10%">Sub Total</td>
                          <td width="15%">Aksi</td>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                        <tfoot>
                        <tr>
                            <td><strong>Estimasi Waktu : </strong></td>
                            <td id="waktu" colspan="3"></td>
                        </tr>
                        <tr>
                        
                            <td colspan="3" align="right"><strong>Total : </strong></td>
                            <td id="total"></td>
                            
                            <td>
                                <input type="hidden" name="waktu_pengerjaan_hidden" value="">
                                <input type="hidden" name="provinsi_id_hidden" value="">
                                <input type="hidden" name="kabupaten_id_hidden" value="">
                                <input type="hidden" name="kecamatan_id_hidden" value="">
                                <input type="hidden" name="total_jasa_hidden" value="">
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
                </div>
            </div>
        </div>
    </div> 
</div>
 
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('estimasi.js')}}"></script>


@endsection



