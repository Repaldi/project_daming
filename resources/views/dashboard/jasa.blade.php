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
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
     
        <div class="card-header border-0">
          <h3 class="mb-0">Data Jasa</h3>
        </div>
        
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Nama Jasa</th>
                <th scope="col" class="sort" data-sort="budget">Harga </th>
                <th scope="col" class="sort" data-sort="completion">Provinsi</th>
                <th scope="col" class="sort" data-sort="completion">Kabupaten</th>
                <th scope="col" class="sort" data-sort="completion">Kecamatan</th>
                <th scope="col" class="sort" data-sort="completion">Aksi</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($jasa as $data_jasa)  
                <tr>
                  <th scope="row">
                    {{$data_jasa->nama_jasa}}
                  </th>
                  <td class="budget">
                    {{$data_jasa->harga_jasa}}
                  </td>
                  <td>
                    {{$data_jasa->provinsi->nama_provinsi}}
                  </td>
                  <td>
                    {{$data_jasa->kabupaten->nama_kabupaten}}
                  </td>
                  <td>
                    {{$data_jasa->kecamatan->nama_kecamatan}}
                  </td>
                  <td class="table-actions">

                        <a href="#" type="button" class="table-action">
                          <i class="fas fa-user-edit"></i> 
                        </a>

                        <a href="#" class="table-action table-action-delete hapus-jasa"  data-jasa_id="{{$data_jasa->id}}" data-toggle="tooltip" data-original-title="Delete Jasa">
                          <i class="fas fa-trash"></i>
                        </a>

                      </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $('.hapus-jasa').click(function(){
			const jasa_id = $(this).data('jasa_id');
			swal({
        title: "Apakah Kamu Yakin?",
        text: "Setelah terhapus, kamu tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = "/jasa/delete/"+jasa_id;
				}
			});
		});
</script>

@if(Session::has('success-delete-jasa'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menghapus Data Jasa",
        icon: "success",
        button: "OK",
    });
</script>
@endif

@endsection


<!-- Modal Tambah Jasa -->

<div class="modal fade create_modal_jasa" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{route('tambahJasa')}}" enctype="multipart/form-data" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jasa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <div class="form-group">
              <label for="judul" class="col-form-label">Nama Jasa:</label>
              <input type="text"  class="form-control" name="nama_jasa" >
            </div> 
            <div class="form-group">
              <label for="judul" class="col-form-label">Harga Jasa:</label>
              <input type="text"  class="form-control" name="harga_jasa" >
            </div> 
            <div class="form-group">
                <select class="form-control" name="provinsi_id" id="provinsi">
                    <option disabled selected>---Pilih Provinsi---</option>
                    @foreach($provinsi as $data_provinsi)
                    <option value="{{$data_provinsi->id}}">{{$data_provinsi->nama_provinsi}}</option>
                    @endforeach    
                </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="kabupaten_id" id="kabupaten">
                <option selected>---Pilih Kabupaten---</option>
              </select>
            </div>                 
            <div class="form-group">
              <select class="form-control" name="kecamatan_id" id="kecamatan">
                <option selected>---Pilih Kecamatan---</option>
              </select>
            </div>                 
        </div>

        <div class="modal-footer">
          <button type="buttom" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="sumbit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Tutup Modal Tambah Jasa -->

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('wilayah.js')}}"></script>
