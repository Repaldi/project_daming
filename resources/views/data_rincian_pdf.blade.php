<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<center>
			<h4>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
			<h5><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5>
		</center>
		<br/>
<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Material</th>
					<th>Satuan</th>
					<th>Banyak</th>
					<th>Sub Harga</th>
				</tr>
			</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($detail_rincian_kalkulasi as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->material->nama_material}}</td>
				<td>{{$p->material->satuan_material}}</td>
				<td>{{$p->banyak_material}}</td>
				<td>{{$p->sub_harga_material}}</td>	
			</tr>
			@endforeach
		</tbody>
</table>

<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Jasa</th>
					<th>Satuan</th>
					<th>Banyak</th>
					<th>Sub Harga</th>
				</tr>
			</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($detail_rincian_estimasi_waktu as $data_estimasi_waktu)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$data_estimasi_waktu->jasa->nama_jasa}}</td>
				<td>{{$data_estimasi_waktu->harga_jasa}}</td>
				<td>{{$data_estimasi_waktu->jumlah_jasa}}</td>
				<td>{{$data_estimasi_waktu->sub_harga_jasa}}</td>	
			</tr>
			@endforeach
		</tbody>
</table>
</div>
 
 </body>
 </html>