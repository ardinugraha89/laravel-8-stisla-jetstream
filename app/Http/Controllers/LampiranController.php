<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index_view()
    {
        return view('pages.lampiran.lampiran-data', [
            'lampiran' => Lampiran::class
        ]);
    }
}
