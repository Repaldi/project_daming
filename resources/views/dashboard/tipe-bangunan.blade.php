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
              <li class="breadcrumb-item"><a href="tables.html#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tipe Bangunan</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
        <button type="submit" class="btn btn-sm btn-neutral" data-toggle="modal" data-target=".create_modal_tipe_bangunan"
                    style="box-shadow: 3px 2px 5px grey; margin:5px;"><i class="fa fa-plus-square"> </i>Tipe Bangunan</button>
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
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Data Tipe Bangunan</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Tipe Bangunan</th>
                <th scope="col" class="sort" data-sort="completion">Provinsi</th>
                <th scope="col" class="sort" data-sort="completion">Kabupaten</th>
                <th scope="col" class="sort" data-sort="completion">Kecamatan</th>
                <th scope="col" class="sort" data-sort="completion">Aksi</th>
                
              </tr>
            </thead>
            <tbody class="list">
            @foreach($tipeBangunan as $data_tipe_bangunan)  
              <tr>
                <th scope="row">
                  {{$data_tipe_bangunan->nama_tipe_bangunan}}
                </th>
                
                <td>
                  {{$data_tipe_bangunan->provinsi->nama_provinsi}}
                </td>
                <td>
                  {{$data_tipe_bangunan->kabupaten->nama_kabupaten}}
                </td>
                <td>
                  {{$data_tipe_bangunan->kecamatan->nama_kecamatan}}
                </td>
                <td class="table-actions">

                        <a href="#" type="button" class="table-action">
                          <i class="fas fa-user-edit"></i> 
                        </a>

                        <a href="#" class="table-action table-action-delete hapus-tipe-bangunan"  data-tipe_bangunan_id="{{$data_tipe_bangunan->id}}" data-toggle="tooltip" data-original-title="Delete Tipe Bangunan">
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
  $('.hapus-tipe-bangunan').click(function(){
			const tipe_bangunan_id = $(this).data('tipe_bangunan_id');
			swal({
        title: "Apakah Kamu Yakin?",
        text: "Setelah terhapus, kamu tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = "/tipe-bangunan/delete/"+tipe_bangunan_id;
				}
			});
		});
</script>

@if(Session::has('success-delete-tipe-bangunan'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menghapus Data Tipe Bangunan",
        icon: "success",
        button: "OK",
    });
</script>
@endif

@endsection


<!-- Modal Tambah Tipe Bangunan -->
<div class="modal fade create_modal_tipe_bangunan" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form action="{{route('tambahTipeBangunan')}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Bangunan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="judul" class="col-form-label">Tipe Bangunan:</label>
            <input type="text"  class="form-control" name="nama_tipe_bangunan" >
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

<!-- Tutup Modal Tambah Info Tipe Bangunan -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('wilayah.js')}}"></script>
