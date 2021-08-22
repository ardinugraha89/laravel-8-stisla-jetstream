<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index_view()
    {
        return view('pages.pangkat.pangkat-data', [
            'pangkat' => Pangkat::class
        ]);
    }
}
