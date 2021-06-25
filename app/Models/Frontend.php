<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Frontend extends Model
{
    use HasFactory;

    public function DataKabkota()
    {
        return DB::table('kab_kotas')->get();
    }

    public function DataKategori()
    {
        return DB::table('kategoriwisatas')->get();
    }

    public function DataWisataKategori($id)
    {
        return DB::table('wisatas')
            ->join('kategoriwisatas', 'kategoriwisatas.id', '=', 'wisatas.id_kategori')
            ->join('kab_kotas', 'kab_kotas.id', '=', 'wisatas.id_kabkota')
            ->where('wisatas.id_kategori', $id)
            ->get(['wisatas.*','kategoriwisatas.kategori','kab_kotas.logo','kab_kotas.kabkota']);
    }

    public function DetailKategori($id)
    {
        return DB::table('kategoriwisatas')->where('id',$id)->first();
    }


    public function DetailDataKabkota($id)
    {
        return DB::table('kab_kotas')->where('id',$id)->first();
    }

    public function DataWisataKabkota($id)
    {
        return DB::table('wisatas')
            ->join('kategoriwisatas', 'kategoriwisatas.id', '=', 'wisatas.id_kategori')
            ->join('kab_kotas', 'kab_kotas.id', '=', 'wisatas.id_kabkota')
            ->where('wisatas.id_kabkota', $id)
            ->get(['wisatas.*','kab_kotas.logo','kab_kotas.kabkota','kategoriwisatas.kategori']);
    }

    public function AllDataWisata()
    {
        return DB::table('wisatas')
            ->join('kategoriwisatas', 'kategoriwisatas.id', '=', 'wisatas.id_kategori')
            ->join('kab_kotas', 'kab_kotas.id', '=', 'wisatas.id_kabkota')
            ->get(['wisatas.*','kategoriwisatas.kategori','kab_kotas.logo','wisatas.nama_wisata','wisatas.posisi']);
    }

    public function DetailWisata($id)
    {
        return DB::table('wisatas')
            ->join('kategoriwisatas', 'kategoriwisatas.id', '=', 'wisatas.id_kategori')
            ->join('kab_kotas', 'kab_kotas.id', '=', 'wisatas.id_kabkota')
            ->where('wisatas.id', $id)
            ->first(['wisatas.*','kategoriwisatas.kategori','kab_kotas.logo']);

    }
}
