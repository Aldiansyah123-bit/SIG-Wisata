<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KabKota;
use App\Models\Kategoriwisata;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_wisata', 'id_kategori', 'id_kabkota', 'alamat', 'posisi', 'deskripsi', 'foto',
    ];

    public function kategory()
    {
        return $this->belongsTo(Kategoriwisata::class, 'id_kategori','id');
    }

    public function kabkota()
    {
        return $this->belongsTo(KabKota::class, 'id_kabkota','id');
    }
}
