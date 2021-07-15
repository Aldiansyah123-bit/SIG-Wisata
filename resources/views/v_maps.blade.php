@extends('layouts.frontend')

@section('content')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<div id="map" style="width: 100%; height: 774px;"></div>

<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiYWxkaTI1NiIsImEiOiJja3F3MG1xeTQwanA4MndvNXF1Mm5sdW5vIn0.r5jcDFTaGdPAZbt7w9lxGw';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [112.19010,-7.67978],
        // pitch: 60, // pitch in degrees
        // bearing: -60, // bearing in degrees
        zoom: 9
    });

    map.addControl(
        new MapboxDirections({
        accessToken: mapboxgl.accessToken
            }),
            'top-left'
    );

    map.addControl(new mapboxgl.NavigationControl());

    map.addControl(
        new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
            },
        trackUserLocation: true
        })
    );
</script>
@endsection
