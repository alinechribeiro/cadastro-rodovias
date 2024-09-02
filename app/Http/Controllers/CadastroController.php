<?php

namespace App\Http\Controllers;

use App\Models\Uf;
use App\Models\Rodovia;

class CadastroController extends Controller
{
    public function index()
    {
        $ufs = Uf::all();
        $rodovias = Rodovia::all();

        return view('cadastro.index', compact('ufs', 'rodovias'));
    }
}