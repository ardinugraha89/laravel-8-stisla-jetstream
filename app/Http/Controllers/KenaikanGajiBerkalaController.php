<?php

namespace App\Http\Controllers;

use App\Models\KenaikanGajiBerkala;
use Illuminate\Http\Request;

class KenaikanGajiBerkalaController extends Controller
{
    public function index_view()
    {
        return view('pages.kgb.kgb-data', [
            'kgb' => KenaikanGajiBerkala::class
        ]);
    }
}
