@extends('layouts.frontend')

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
<div class="container">
    <br>
    <h2 class="text-center"><b>{{$wisata->nama_wisata}}</b></h2>
    <br>
    <div class="col-sm-6">
        <img src="{{ asset('foto') }}/{{ $wisata->foto }}" width="200%" height="600px">
    </div>
    <br>
    <div>
        <p>{{$wisata->deskripsi}}</p>
    </div>
</div>


@endsection
