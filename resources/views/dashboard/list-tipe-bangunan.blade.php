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
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
      <div class="card-header">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Data Tipe Bangunan </h3>
            </div>
            <div class="col-2 text-right">
              <a href="{{route('formTipeBangunan')}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tipe Bangunan</a>                      
            </div>
          </div>
        </div>
        <div class="card-body">
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

                        <a href="{{route('editTipeBangunan', $data_tipe_bangunan->id)}}" type="button" class="table-action">
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
          {{$tipeBangunan->links()}}
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
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

@if(Session::has('success-add-tipe-bangunan'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menambahkan Data Tipe Bangunan",
        icon: "success",
        button: "OK",
    });
</script>
@endif
@endsection
