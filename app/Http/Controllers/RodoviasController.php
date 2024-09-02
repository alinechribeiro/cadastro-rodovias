<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rodovia;

class RodoviasController extends Controller
{
    public function show($id)
    {
        return Rodovia::with(['uf:id,sigla'])
            ->select('rodovias.*', 'ufs.sigla as uf_sigla')
            ->join('ufs', 'rodovias.uf_id', '=', 'ufs.id')
            ->where('ufs.id', $id)
            ->get();
    }
}
