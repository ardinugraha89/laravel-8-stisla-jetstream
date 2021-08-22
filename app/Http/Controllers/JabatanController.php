<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index_view()
    {
        return view('pages.riwayat.jabatan-data', [
            'riwayatJabatan' => RiwayatJabatan::class
        ]);
    }
}
