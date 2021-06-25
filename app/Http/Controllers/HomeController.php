<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'kabkota' => DB::table('kab_kotas')->count(),
            'kategori' => DB::table('kategoriwisatas')->count(),
            'wisata' => DB::table('wisatas')->count(),
        ];
        return view('dashboard', $data);
    }
}
