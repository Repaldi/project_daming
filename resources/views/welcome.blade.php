@extends('layouts.master-front-end')
@section('content')
    

<div class="container-fluid mt--2">
    <div class="row">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-12">
                        <h3 class="mb-0">PILIH PROYECT</h3>
                    </div>
                    </div>
                </div>
                
                <div class="card-body" id="content" >
                    <div class="row">
                        <div class="col-12" >
                            <button type="button" class="btn btn-success mb-3 btn-block" id="standar"> Standar </button>                      
                            <button type="button" class="btn btn-primary btn-block" id="kostum"> Kostum Sendiri</button>                      
                        </div>
                    </div>      
                </div> 
            </div>
        </div>

        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-12">
                        <h3 class="mb-0">FORM KALKULASI <span class="badge badge-success">STANDAR</span></h3>
                    </div>
                    </div>
                </div>
                
             
                <div class="card-body" id="contentStandar" >
                    
                    <div class="row">

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
                                <label class="form-control-label" for="input-tipebangunan">Tipe Bangunan</label>
                                <select class="form-control" name="tipe_bangunan_id" id="tipebangunan">
                                    <option selected>Pilih Tipe Bangunan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                            <label for="">&nbsp;</label>
                                <button disabled type="submit" class="btn btn-primary btn-block" id="searchData"><i class="fa fa-search"></i> Cari</button>                      
                            </div>
                        </div>

                    </div>

                    <hr class="my-4" /> 
                   
                    <div class="row" id="totalHarga">
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <span id="total_harga_bangunan"> </span> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>     
                            </div>
                        </div>
                    </div>

                </div> 
            </div>

            <div class="card" id="formTambahan">        
                <div class="card-body" >   
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-estimasi_waktu"> Waktu Pengerjaan</label>

                                    <select class="form-control" name="estimasi_waktu_id" id="estimasi_waktu_id">
                                        <option selected>Pilih Waktu Pengerjaan </option>
                                    </select>

                                </div>
                            </div>
                    </div>
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
                            <tbody id="tbodyid">
                            </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                       <center> <button  type="button" class="btn  btn-block btn-primary" id="btnResetEstimasiWaktu"><i class="fa fa-undo"></i> Ganti Estimasi Waktu</button> </center>
                                    </td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                    <hr class="my-4" /> 
                   

                </div>
                
            </div>
        </div>
    </div> 
   
</div>  

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('enduser.js')}}"></script>

@endsection
    


