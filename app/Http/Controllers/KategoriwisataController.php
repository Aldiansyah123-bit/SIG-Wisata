<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategoriwisata;

class KategoriwisataController extends Controller
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
            'title' => 'Kategori Wisata'
        ];

        $kategori = Kategoriwisata::all();

        return view('admin.kategori.index',compact('kategori'), $data);
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
                'kategori'  => 'required',
            ],
            [
                'kategori.required' => 'Kategori Wajib Diisi !!!',
            ]);

            Kategoriwisata::create([
                'kategori'  => $request->kategori,
            ]);

            return redirect('kategori')->with('status', 'Data Berhasil Disimpan !!!');
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
            'title' => 'Tambah Kategori Wisata',
        ];
        return view('admin/kategori/add', $data);
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
            'title' => 'Edit Kategori Wisata'
        ];

        $kategori = Kategoriwisata::where('id', $id)->first();

        return view('admin.kategori.edit', compact('kategori'), $data);
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
                'kategori'  => 'required',
            ],
            [
                'kategori.required' => 'Kategori Wajib Diisi !!!',
            ]);

            Kategoriwisata::findOrFail($id)->update([
                'kategori'  => $request->kategori,
            ]);

            return redirect('kategori')->with('status', 'Data Berhasil Disimpan !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategoriwisata::destroy($id);

        return redirect('kategori')->with('status', 'Data Berhasil Di Hapus');
    }
}
