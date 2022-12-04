<?php

namespace App\Http\Controllers\quran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class quranController extends Controller
{
    public function index()
    {
        return view('quran.quran');
    }
}
