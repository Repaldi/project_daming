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
              <li class="breadcrumb-item active" aria-current="page">Estimasi Waktu</li>
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
              <h3 class="mb-0">Data Estimasi Waktu</h3>
            </div>
            <div class="col-lg-2 text-right">
              <a href="{{route('formEstimasiWaktu')}}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Estimasi Waktu</a>                      
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
                      <th scope="col" class="sort" data-sort="name">No</th>
                      <th scope="col" class="sort" data-sort="completion">Tanggal </th>
                      <th scope="col" class="sort" data-sort="completion">Total Harga Jasa</th>
                      <th scope="col" class="sort" data-sort="completion">Waktu Pengerjaan</th>
                      <th scope="col" class="sort" data-sort="completion">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  @foreach($estimasi_waktu as $data_estimasi_waktu)
                    <tr>
                      <th scope="row">
                      {{$loop->iteration}}
                      </th>
                      <td class="budget">
                        {{$data_estimasi_waktu->created_at}}
                      </td>
                      <td class="budget">
                        {{$data_estimasi_waktu->total_harga_jasa}}
                      </td>
                      <td class="budget">
                        {{$data_estimasi_waktu->waktu_pengerjaan}}
                      </td>
                      <td class="table-actions">

                        <a href="{{route('formDetailEstimasiWaktu', $data_estimasi_waktu->id)}}" type="button" class="table-action">
                          <i class="fas fa-info-circle"></i> 
                        </a>

                        <a href="#" class="table-action table-action-delete hapus-estimasi_waktu"  data-estimasi_waktu_id="{{$data_estimasi_waktu->id}}" data-toggle="tooltip" data-original-title="Delete Estimasi Waktu">
                          <i class="fas fa-trash"></i>
                        </a>

                      </td>

                    </tr>
                  @endforeach
                  </tbody>
                </table>
                {{$estimasi_waktu->links()}}
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
  $('.hapus-estimasi_waktu').click(function(){
			const estimasi_waktu_id = $(this).data('estimasi_waktu_id');
			swal({
        title: "Apakah Kamu Yakin?",
        text: "Setelah terhapus, kamu tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = "/list-estimasi-waktu/delete/"+estimasi_waktu_id;
				}
			});
		});
</script>

@if(Session::has('success-delete-estimasi-waktu'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menghapus Data Estimasi Waktu",
        icon: "success",
        button: "OK",
    });
</script>
@endif
@endsection



