<?php

namespace App\Http\Controllers;

use App\Models\Frondend;
use Illuminate\Http\Request;
use App\Models\Frontend;

class FrondendController extends Controller
{
    public function __construct()
    {
        $this->Frontend = new Frontend();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'     => 'Pemetaan',
            'kabkota'   => $this->Frontend->DataKabkota(),
            'wisata'    => $this->Frontend->AllDataWisata(),
            'kategori'  => $this->Frontend->DataKategori(),
        ];
        return view('v_frondend', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function maps()
    {
        $wisata = $this->Frontend->DetailWisata('id');
        $data = [
            'title'     => 'Maps',
            'kabkota'   => $this->Frontend->DataKabkota(),
            'wisata'    => $this->Frontend->AllDataWisata(),
            'kategori'  => $this->Frontend->DataKategori(),
        ];
        return view('v_maps', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kabkota($id)
    {
        $kabkota = $this->Frontend->DetailDataKabkota($id);
        $data = [
            'title'     => $kabkota->kabkota,
            'kabkota'   => $this->Frontend->DataKabkota(),
            'kategori'  => $this->Frontend->DataKategori(),
            'wisata'    => $this->Frontend->DataWisataKabkota($id),
            'kbkot'     => $kabkota
        ];

        return view('v_kabkota',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frondend  $frondend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wisata = $this->Frontend->DetailWisata($id);
        $data = [
            'title'     => 'Detail '. $wisata->nama_wisata,
            'kabkota'   => $this->Frontend->DataKabkota(),
            'kategori'  => $this->Frontend->DataKategori(),
            'wisata'    => $wisata,
        ];
        return view('v_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frondend  $frondend
     * @return \Illuminate\Http\Response
     */
    public function kategori($id)
    {
        $kateg = $this->Frontend->DetailKategori($id);
        $data = [
            'title'     => 'Kategori '. $kateg->kategori,
            'kabkota'   => $this->Frontend->DataKabkota(),
            'kategori'  => $this->Frontend->DataKategori(),
            'wisata'    => $this->Frontend->DataWisataKategori($id),
        ];

        return view('v_kategori',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frondend  $frondend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frondend  $frondend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
