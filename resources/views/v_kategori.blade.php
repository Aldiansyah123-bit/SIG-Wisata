@extends('layouts.frontend')

@section('content')

<div id="map" style="width: 100%; height: 700px;"></div>

<div class="col-sm-12">
	<br>
	<br>
	<div class="text-center"><h2><b>Data {{ $title }}</b></h2></div>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="30px" class="text-center">No</th>
				<th class="text-center">Nama Wisata </th>
				<th width="50px" class="text-center">Kabupaten/Kota</th>
				<th class="text-center">Jenis Wisata</th>
				<th class="text-center">Coordinat</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; ?>
			@foreach ($wisata as $data)
				<tr>
					<td class="text-center">{{ $no++ }}</td>
					<td>{{ $data->nama_wisata }}</td>
					<td>{{ $data->kabkota}}</td>
					<td>{{ $data->kategori }}</td>
					<td>{{ $data->posisi}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>


<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/satellite-v9'
	});


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/dark-v10'
	});



    var map = L.map('map', {
        center  : [-7.499256541508711, 112.53985451549833],
        zoom    : 9,
        layers  : [peta2]
    });

    var baseMaps = {
        "Grayscale" : peta1,
        "Satelite"  : peta2,
        "Streets"   : peta3,
        "Dark"      : peta4,
    };

    L.control.layers(baseMaps).addTo(map);

	@foreach ($wisata as $data)

	var iconwisata = L.icon({
			iconUrl     : '{{ asset('logo') }}/{{ $data->logo }}',
			iconSize    : [60, 60],
		});
		var informasi = '<table class="table table-bordered"><tr><td colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="250px"></th></tr><tbody><tr><td><span>Nama Wisata</span></td><td>{{ $data->nama_wisata }}</td></tr><tr><td>Kategori</td><td>{{ $data->kategori }}</td></tr><tr><td>Kabupaten/Kota</td><td>{{ $data->kabkota }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailwisata/{{ $data->id }}" class="btn btn-sm btn-default">Detail</a></td></tr></tbody></table>';
		L.marker([<?= $data->posisi ?>], {icon : iconwisata})
		.addTo(map)
		.bindPopup(informasi);

	@endforeach

</script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

@endsection


