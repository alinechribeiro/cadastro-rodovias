<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UF;

class UFController extends Controller
{
    public function show(Request $request)
    {
        return UF::all();
    }
}