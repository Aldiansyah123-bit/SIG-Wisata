@extends('layouts.backend')

@section('judul1')
    {{$title ?? ''}}
@endsection

@section('judul2')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
        <div class="col-sm-6">
            <h1 class="m-0"> {{$title ?? ''}}</h1>
        </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data {{ $title }}</h3>
        </div>
        <form action="/wisata/update/{{ $wisata->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama Wisata</label>
                                <input name="nama_wisata" class="form-control" value="{{$wisata->nama_wisata}}">
                                <div class="text-danger">
                                    @error('nama_wisata')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <option value="{{$wisata->id}}">{{$wisata->kategory->kategori}}</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('id_kategori')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Deskripsi Wisata</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Wisata" rows="5">{{$wisata->deskripsi}}</textarea>
                                <div class="text-danger">
                                    @error('deskripsi')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                                <select name="id_kabkota" class="form-control">
                                    <option value="{{ $wisata->id }}">{{ $wisata->kabkota->kabkota }}</option>
                                    @foreach ($kabkota as $data)
                                        <option value="{{ $data->id }}">{{ $data->kabkota }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('id_kabkota')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Alamat Wisata</label>
                                <input name="alamat" class="form-control" value="{{$wisata->alamat}}">
                                <div class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Posisi Wisata</label>
                                <input name="posisi" id="posisi" class="form-control" value="{{$wisata->posisi}}">
                                <div class="text-danger">
                                    @error('posisi')
                                        {{ $message }}
                                    @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Foto Wisata</label>
                                <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg" value="{{$wisata->foto}}">
                            <div class="text-danger">
                                @error('foto')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label>Map</label><label class="text-danger">(Drag and Drop Marker atau klik map untuk menentukan posisi Wisata)</label>
                        <div id="map" style="width: 100%; height: 700px;"></div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan</button>
                <a href="/wisata" class="float-right btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
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
        center  : [{{ $wisata->posisi }}],
        zoom    : 14,
        layers  : [peta1],
    });

    var baseMaps = {
        "Grayscale" : peta1,
        "Satelite"  : peta2,
        "Streets"   : peta3,
        "Dark"      : peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    //Mengambil Titik Koordinat
    var curLocation = [{{ $wisata->posisi }}];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation,{
        draggable : 'true',
    });
    map.addLayer(marker);

    //Ambil Koordinat Saat Marker Drag and Drop
    marker.on('dragend', function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable : 'true',
        }).bindPopup(position).update();
        $("#posisi").val(position.lat + "," + position.lng).keyup();
    });

    //Ambil Koordinat saat map diklik
    var posisi = document.querySelector("[name=posisi]");
    map.on("click", function(event){
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;
        if (!marker) {
            marker = L.marker(event.latlng).addTo(map);
        } else{
             marker.setLatLng(event.latlng);
        }
        posisi.value = lat + "," + lng;
    });

</script>
@endsection
