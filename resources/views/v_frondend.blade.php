@extends('layouts.frontend')

@section('content')

<div id="map" style="width: 100%; height: 800px;"></div>


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

    @foreach ($kabkota as $data)
		var data{{ $data->id }} = L.layerGroup();
	@endforeach

	var wisata = L.layerGroup();

    var map = L.map('map', {
        center  : [-7.863740050473507, 112.63727234652208],
        zoom    : 10,
        layers  : [peta2,
		@foreach ($kabkota as $data)
			data{{ $data->id }},
		@endforeach

		wisata,
		]
    });

    var baseMaps = {
        "Grayscale" : peta1,
        "Satelite"  : peta2,
        "Streets"   : peta3,
        "Dark"      : peta4,
    };

	var overlayer = {
		@foreach ($kabkota as $data)
			"{{ $data->kabkota }}" : data{{ $data->id }},
		@endforeach
		"Wisata" : wisata,
	};

    L.control.layers(baseMaps, overlayer).addTo(map);

	@foreach ($kabkota as $data)

		L.geoJSON(<?= $data->geojs ?>,{
			style : {
				color       : 'white',
				fillColor   : '{{ $data->warna }}',
				fillOpacity : 0.8,
			},
		}).addTo(data{{ $data->id }});

	@endforeach

	@foreach ($wisata as $data)
		var iconwisata = L.icon({
			iconUrl     : '{{ asset('logo') }}/{{ $data->logo }}',
			iconSize    : [60, 60],
		});
		var informasi = '<table class="table table-bordered"><tr><td colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="250px"></th></tr><tbody><tr><td><span>Nama Wisata</span></td><td>{{ $data->nama_wisata }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailwisata/{{ $data->id }}" class="btn btn-sm btn-default">Detail</a></td></tr></tbody></table>';
		L.marker([<?= $data->posisi ?>], {icon : iconwisata})
		.addTo(wisata)
		.bindPopup(informasi);
	@endforeach

</script>
@endsection


