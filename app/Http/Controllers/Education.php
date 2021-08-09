<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Education extends Controller
{
    public function index_view()
    {
        return view('pages.edu.edu-data', [
            'edu' => Edu::class
        ]);
    }
}
