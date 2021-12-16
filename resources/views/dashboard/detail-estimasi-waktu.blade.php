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
              <li class="breadcrumb-item active" aria-current="page">Detail Estimasi Waktu</li>
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
              <div class="row">
                  <div class="col-10">
                  <h3 class="mb-0">Detail Estimasi Waktu </h3>
                  </div>
                  <div class="col-2">
                    <a href="{{route('listEstimasiWaktu')}}" type="button" class="btn btn-primary btn-block"><i class="fa fa-reply"></i> Kembali</a>  
                  </div>
              </div>
            </div>
            
            <div class="card-body">
           
                <div class="row">
                    <div class="col-12 ">
                        <h4> Tanggal Pembuatan Estimasi Waktu : {{$estimasi_waktu->created_at}} </h4>
                    </div>
                   
                    <div class="col-12">
                        <span class="badge badge-info">Total Jasa: {{$estimasi_waktu->total_jasa}}</span>
                        <span class="badge badge-success">Total Harga : {{$estimasi_waktu->total_harga_jasa}}</span>
                    </div>

            
                </div>   
             
                <hr class="my-4" />
            
                <div class="row">
                  <div class="col-lg-12">
                    <table class="table table-bordered" id="keranjang">
                      <thead>
                        <tr>
                          <td width="35%">Nama Jasa</td>
                          <td width="15%">Harga</td>
                          <td width="15%">Jumlah</td>
                          <td width="10%">Sub Harga</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($detail_estimasi_waktu as $item)
                        <tr>
                            <td width="35%">{{$item->jasa->nama_jasa}}</td>
                            <td width="15%">{{$item->harga_jasa}}</td>
                            <td width="15%">{{$item->jumlah_jasa}}</td>
                            <td width="10%">{{$item->sub_harga_jasa}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                </form>
                
                
            </div>      
          </div>
        </div>
      </div> 
</div>
 
@endsection



