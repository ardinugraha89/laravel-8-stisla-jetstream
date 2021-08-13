<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index_view()
    {
        return view('pages.edu.edu-data', [
            'edu' => Education::class
        ]);
    }
}
