<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index_view()
    {
        return view('pages.pelatihan.pelatihan-data', [
            'pelatihan' => Pelatihan::class
        ]);
    }
}
