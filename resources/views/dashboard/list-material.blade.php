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
                  <li class="breadcrumb-item active" aria-current="page">Material</li>
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Data Material </h3>
            </div>
            <div class="col-2">
              <a href="{{route('formMaterial')}}" type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Material</a>                      
            </div>
          </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort" data-sort="name">Nama material</th>
                <th scope="col" class="sort" data-sort="budget">Harga </th>
                <th scope="col" class="sort" data-sort="status">Satuan</th>
                <th scope="col" class="sort" data-sort="completion">Provinsi</th>
                <th scope="col" class="sort" data-sort="completion">Kabupaten</th>
                <th scope="col" class="sort" data-sort="completion">Kecamatan</th>  
                <th scope="col" class="sort" data-sort="completion">Aksi</th>  
              </tr>
            </thead>
              <tbody class="list">
                @foreach($material as $data_material)  
                  <tr>
                    <th scope="row">
                      {{$data_material->nama_material}}
                    </th>
                    <td class="budget">
                    {{$data_material->harga_material}}
                    </td>
                    <td>
                      {{$data_material->satuan_material}}
                    </td>
                    <td>
                      {{$data_material->provinsi->nama_provinsi}}
                    </td>
                    <td>
                    @if($data_material->kabupaten_id != Null)
                    {{$data_material->kabupaten->nama_kabupaten}}
                    @else
                    -
                    @endif
                  </td>
                  <td>
                  @if($data_material->kecamatan_id != Null)
                    {{$data_material->kecamatan->nama_kecamatan}}
                    @else
                    -
                    @endif
                  </td>
                    <td class="table-actions">

                        <a href="{{route('editMaterial', $data_material->id)}}" type="button" class="table-action">
                          <i class="fas fa-user-edit"></i> 
                        </a>

                        <a href="#" class="table-action table-action-delete hapus-material"  data-material_id="{{$data_material->id}}" data-toggle="tooltip" data-original-title="Delete Material">
                          <i class="fas fa-trash"></i>
                        </a>

                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          {{$material->links()}}
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
  $('.hapus-material').click(function(){
			const material_id = $(this).data('material_id');
			swal({
        title: "Apakah Kamu Yakin?",
        text: "Setelah terhapus, kamu tidak dapat mengembalikan data ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location = "/material/delete/"+material_id;
				}
			});
		});
</script>

@if(Session::has('success-delete-material'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menghapus Data Material",
        icon: "success",
        button: "OK",
    });
</script>
@endif

@if(Session::has('success-add-material'))
<script>
    swal({
        title: "Berhasil",
        text: "Berhasil Menambahkan Data Material",
        icon: "success",
        button: "OK",
    });
</script>
@endif
@endsection



