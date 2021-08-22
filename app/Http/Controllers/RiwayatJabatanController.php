<?php

namespace App\Http\Controllers;

use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;

class RiwayatJabatanController extends Controller
{
    public function index_view()
    {
        return view('pages.riwayatjbt.riwayatjbt-data', [
            'riwayatjbt' => RiwayatJabatan::class
        ]);
    }
}
