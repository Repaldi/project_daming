@extends('layouts.master-dashboard')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="dashboard.html#">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kalkulasi Harga</li>
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
              <h3 class="mb-0">Data Kalkulasi </h3>
            </div>
            <div class="col-2">
              <a href="{{route('formKalkulasi')}}" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Kalkulasi</a>                      
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">       
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" class="sort" data-sort="name">Kode Kalkulasi</th>
                      <th scope="col" class="sort" data-sort="completion">Tanggal Perhitungan</th>
                      <th scope="col" class="sort" data-sort="completion">Total Harga</th>
                      <th scope="col" class="sort" data-sort="completion">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  @foreach($kalkulasi as $data_kalkulasi)
                    <tr>
                      <th scope="row">
                        {{$data_kalkulasi->kode_kalkulasi}}
                      </th>
                      <td class="budget">
                        {{$data_kalkulasi->created_at}}
                      </td>
                      <td class="budget">
                        {{$data_kalkulasi->total_harga}}
                      </td>
                      <td class="table-actions">

                        <a href="{{route('formDetailKalkulasi', $data_kalkulasi->id)}}" type="button" class="table-action">
                          <i class="fas fa-info-circle"></i> 
                        </a>

                        <a href="#" class="table-action table-action-delete hapus-kalkulasi"  data-kalkulasi_id="{{$data_kalkulasi->id}}" data-toggle="tooltip" data-original-title="Delete Kalkulasi">
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
    </div>
  </div> 
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="{{asset('assets_dashboard/vendor/jquery/dist/jquery.min.js')}}"></script>
<script>
  $('.hapus-kalkulasi').click(function(){
			const kalkulasi_id = $(this).data('kalkulasi_id');
			swal({
        title: "Apakah Kamu Yakin?",
        text: "Setelah terhapus, kamu tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = "/list-kalkulasi/delete/"+kalkulasi_id;
				}
			});
		});
</script>

@if(Session::has('success-delete-kalkulasi'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menghapus Data Kalkulasi",
        icon: "success",
        button: "OK",
    });
</script>
@endif
@endsection



