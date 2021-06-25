<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\KabKota;
use App\Models\Kategoriwisata;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Wisata'
        ];

        $wisata = Wisata::all();

        return view('admin.wisata.index',compact('wisata'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama_wisata'   => 'required',
            'id_kategori'   => 'required',
            'id_kabkota'    => 'required',
            'alamat'        => 'required',
            'posisi'        => 'required',
            'deskripsi'     => 'required',
            'foto'          => 'required',
        ],[
            'nama_wisata.required'  => 'Nama Wisata wajib diisi !!',
            'id_kategori.required'  => 'Kategori wajib diisi !!',
            'id_kabkota.required'   => 'Kabupaten Kota wajib diisi !!',
            'alamat.required'       => 'Alamat wajib diisi !!',
            'posisi.required'       => 'Posisi wajib diisi !!',
            'deskripsi.required'    => 'Deskripsi wajib diisi !!',
            'foto.required'         => 'Foto wajib diisi !!',
        ]);

        $file     = Request()->foto;
        $filename = $file->getClientOriginalName();
        $file     ->move(public_path('foto'),$filename);


        Wisata::create([
            'nama_wisata'   => $request->nama_wisata,
            'id_kategori'   => $request->id_kategori,
            'id_kabkota'    => $request->id_kabkota,
            'alamat'        => $request->alamat,
            'posisi'        => $request->posisi,
            'deskripsi'     => $request->deskripsi,
            'foto'          => $filename,
        ]);

        return redirect('wisata')->with('status', 'Data Berhasil Di Tambah !!!');
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
            'title' => 'Tambah Data Wisata'
        ];

        $kategori = Kategoriwisata::all();
        $kabkota  = KabKota::all();
        return view('admin.wisata.add', compact('kategori','kabkota'), $data);
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
            'title' => 'Edit Data Wisata'
        ];
        $kategori = Kategoriwisata::all();
        $kabkota = KabKota::all();
        $wisata = Wisata::where('id',$id)->first();

        return view('admin.wisata.edit', compact('wisata','kabkota','kategori'),$data);
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
        $request->validate([
            'nama_wisata'   => 'required',
            'id_kategori'   => 'required',
            'id_kabkota'    => 'required',
            'alamat'        => 'required',
            'posisi'        => 'required',
            'deskripsi'     => 'required',
        ],[
            'nama_wisata.required'  => 'Nama Wisata wajib diisi !!',
            'id_kategori.required'  => 'Kategori wajib diisi !!',
            'id_kabkota.required'   => 'Kabupaten Kota wajib diisi !!',
            'alamat.required'       => 'Alamat wajib diisi !!',
            'posisi.required'       => 'Posisi wajib diisi !!',
            'deskripsi.required'    => 'Deskripsi wajib diisi !!',
        ]);

        if (Request()->foto <> "") {
            //Hapus gambar Lama
            $foto = Wisata::where('id',$id)->first();
            if ($foto->foto <> "") {
                unlink(public_path('foto'). '/' .$foto->foto);
            }

            //jika ingin ganti gambar
            $file       = Request()->foto;
            $filefoto   = $file->getClientOriginalName();
            $file       ->move(public_path('foto'),$filefoto);

            Wisata::findOrFail($id)->update([
                'nama_wisata'   => $request->nama_wisata,
                'id_kategori'   => $request->id_kategori,
                'id_kabkota'    => $request->id_kabkota,
                'alamat'        => $request->alamat,
                'posisi'        => $request->posisi,
                'deskripsi'     => $request->deskripsi,
                'foto'          => $filefoto,
            ]);

        } else {

            //Jika tidak ingin mengganti Foto
            Wisata::findOrFail($id)->update([
                'nama_wisata'   => $request->nama_wisata,
                'id_kategori'   => $request->id_kategori,
                'id_kabkota'    => $request->id_kabkota,
                'alamat'        => $request->alamat,
                'posisi'        => $request->posisi,
                'deskripsi'     => $request->deskripsi,
            ]);
        }

        return redirect('wisata')->with('status', 'Data Berhasil Di Update !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Wisata::destroy($id);
        return redirect('wisata')->with('status','Data Berhasil di Hapus !!!');
    }
}
