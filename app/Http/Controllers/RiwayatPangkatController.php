<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;

class RiwayatPangkatController extends Controller
{
    public function index_view()
    {
        return view('pages.riwayatpkt.riwayatpkt-data', [
            'riwayatpkt' => RiwayatPangkat::class
        ]);
    }
}
