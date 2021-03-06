@extends('layouts.master-dashboard')
@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="tables.html#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="tables.html#">Dahboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Jasa</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <button type="submit" class="btn btn-sm btn-neutral" data-toggle="modal" data-target=".create_modal_jasa"
            style="box-shadow: 3px 2px 5px grey; margin:5px;"><i class="fa fa-plus-square"> </i>Jasa</button>
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
                  <h3 class="mb-0">Tambah Data Jasa </h3>
                  </div>
                  <div class="col-2">
                  <a href="{{route('jasa')}}" type="button" class="btn btn-primary btn-block"><i class="fa fa-reply"></i> Kembali</a>  
                  </div>
              </div>
            </div>

            <form action="{{route('tambahJasa')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card-body" id="content" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="judul" class="col-form-label">Nama Jasa:</label>
                            <input type="text"  class="form-control" name="nama_jasa" >
                        </div> 
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="judul" class="col-form-label">Harga Jasa:</label>
                        <input type="text"  class="form-control" name="harga_jasa" >
                      </div> 
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                          <select class="form-control" name="provinsi_id" id="provinsi">
                              <option disabled selected>---Pilih Provinsi---</option>
                              @foreach($provinsi as $data_provinsi)
                              <option value="{{$data_provinsi->id}}">{{$data_provinsi->nama_provinsi}}</option>
                              @endforeach    
                          </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <select class="form-control" name="kabupaten_id" id="kabupaten">
                          <option value="" selected>---Pilih Kabupaten---</option>
                        </select>  
                      </div>   
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <select class="form-control" name="kecamatan_id" id="kecamatan">
                          <option value="" selected>---Pilih Kecamatan---</option>
                        </select> 
                      </div>    
                    </div>
                </div> 
                <hr class="my-4" />
            
            <div class="modal-footer">
              <button type="buttom" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="sumbit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
       
            </div> 
         
          </div>
        </div>
      </div> 
</div>
 
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('wilayah.js')}}"></script>


@endsection

