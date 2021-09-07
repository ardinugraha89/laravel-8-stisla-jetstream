<?php

namespace App\Http\Controllers;

use App\Models\CatatanMutasi;
use Illuminate\Http\Request;

class CatatanMutasiController extends Controller
{
    public function index_view()
    {
        return view('pages.mutasi.mutasi-data', [
            'catatanMutasi' => CatatanMutasi::class
        ]);
    }
}
