<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;

class KabkotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Kabupaten Kota'
        ];

        $kabkota = KabKota::all();

        return view('admin.kabkota.index',compact('kabkota'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate(
        [
            'kabkota' => 'required',
            'logo'    => 'required',
            'warna'   => 'required',
            'geojs'   => 'required',
        ],
        [
            'kabkota.required' => 'Kabupaten/Kota Wajib Diisi !!!',
            'logo.required'    => 'Logo Wajib Diisi !!!',
            'warna.required'   => 'Warna Wajib Diisi !!!',
            'geojs.required'   => 'Geojson Wajib Diisi !!!',
        ]);

        $file     = Request()->logo;
        $filename = $file->getClientOriginalName();
        $file     ->move(public_path('logo'),$filename);

        KabKota::create([
            'kabkota'   => $request->kabkota,
            'logo'      => $filename,
            'warna'     => $request->warna,
            'geojs'     => $request->geojs,
        ]);

        return redirect('kabkota')->with('status', 'Data Berhasil Disimpan !!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => 'Tambah Kabupaten/Kota',
        ];
        return view('admin/kabkota/add', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kabupaten/Kota',
        ];

        $kabkota = KabKota::where('id', $id)->first();

        return view('admin/kabkota/edit',compact('kabkota'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kabkota' => 'required',
                'warna'   => 'required',
                'geojs'   => 'required',
            ],
            [
                'kabkota.required' => 'Kabupaten/Kota Wajib Diisi !!!',
                'warna.required'   => 'Warna Wajib Diisi !!!',
                'geojs.required'   => 'Geojson Wajib Diisi !!!',
            ]);

            if (Request()->logo <> "") {
                //Hapus gambar Lama
                $logo = KabKota::where('id',$id)->first();
                if ($logo->logo <> "") {
                    unlink(public_path('logo'). '/' .$logo->logo);
                }

                //jika ingin ganti gambar
                $file       = Request()->logo;
                $filelogo   = $file->getClientOriginalName();
                $file       ->move(public_path('logo'),$filelogo);

            KabKota::findOrFail($id)->update([
                'kabkota'   => $request->kabkota,
                'logo'      => $filelogo,
                'warna'     => $request->warna,
                'geojs'     => $request->geojs,
            ]);

        } else {

            //Jika tidak ingin mengganti icon
            KabKota::findOrFail($id)->update([
                'kabkota'   => $request->kabkota,
                'warna'     => $request->warna,
                'geojs'     => $request->geojs,
            ]);
        }

            return redirect('kabkota')->with('status', 'Data Berhasil Di Update !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabkota = KabKota::where('id',$id)->first();

        if ($kabkota->logo <> "") {
            unlink(public_path('logo'). '/' .$kabkota->logo);
        }

        KabKota::destroy($id);
        return redirect('kabkota')->with('status', 'Data Berhasil Di Hapus !!!');
    }
}
