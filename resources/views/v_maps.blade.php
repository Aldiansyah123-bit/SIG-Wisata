@extends('layouts.frontend')

@section('content')

{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> --}}

<link rel="stylesheet" href="{{ asset('leaflet-routing/dist/leaflet-routing-machine.css') }}" />
<script src="{{ asset('leaflet-routing/dist/leaflet-routing-machine.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('leaflet-search/src/leaflet-search.css') }}" />
<script src="{{ asset('leaflet-search/src/leaflet-search.js') }}"></script>



<div class="text-center col-sm-12">
    <label>Map</label><label class="text-danger">(Drag and Drop Marker atau geser marker untuk menentukan posisi mulai dan tujuan)</label>
</div>

<div id="map" style="width: 100%; height: 800px;"></div>

<script>

    var data = [
        <?php foreach ($wisata as $key => $item) { ?>
            {"lokasi":[<?=$item->posisi?>],"nama_wisata":"<?= $item->nama_wisata?>"},
        <?php } ?>
    ];

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

    var markersLayer = new L.LayerGroup();

    map.addLayer(markersLayer);

	map.addControl( new L.Control.Search({
		layer       : markersLayer,
		initial     : false,
        zoom        : 17,
		collapsed   : true
	}));

    var iconwisata = L.icon({
			iconUrl     : 'wisata.png',
			iconSize    : [40, 60],
            iconAnchor  : [22,65],
            popupAnchor : [-3,-55],
		});

    for(i in data) {
		var nama    = data[i].nama_wisata;
		var	loc     = data[i].lokasi;
		var	marker  = new L.Marker(new L.latLng(loc), {title: nama,icon:iconwisata});
		marker.bindPopup('Wisata: '+ nama );
		markersLayer.addLayer(marker);
	}

    L.Routing.control({
        waypoints: [
            L.latLng(-7.975002194493536, 112.95617670056174),//Titik A
            L.latLng(-7.844216453953317, 113.01784371306502) //Titik B
        ]
    }).addTo(map);

</script>
@endsection
