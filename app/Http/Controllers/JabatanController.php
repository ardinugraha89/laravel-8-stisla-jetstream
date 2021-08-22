<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index_view()
    {
        return view('pages.jabatan.jabatan-data', [
            'jabatan' => Jabatan::class
        ]);
    }
}
