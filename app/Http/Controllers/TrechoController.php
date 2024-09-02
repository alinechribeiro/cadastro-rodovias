<?php

namespace App\Http\Controllers;

use App\Models\Trecho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TrechoController extends Controller
{
    public function store(array $data)
    {
        try {
            $trecho = Trecho::create([
                'data_referencia' => $data['data_referencia'],
                'uf_id' => $data['uf_id'],
                'rodovia_id' => $data['br'],
                'quilometragem_inicial' => $data['km_inicial'],
                'quilometragem_final' => $data['km_final'],
                'geo' => json_encode($data['geo']),
            ]);

            return response()->json(['success' => true, 'trecho' => $trecho]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar a requisição: ' . $e->getMessage()], 500);
        }
    }

    public function fetchTrechos(Request $request)
    {
        $query = Trecho::query()
            ->join('ufs', 'trechos.uf_id', '=', 'ufs.id')
            ->join('rodovias', 'trechos.rodovia_id', '=', 'rodovias.id')
            ->select([
                'trechos.id',
                'trechos.data_referencia',
                'ufs.sigla as uf_sigla',
                'rodovias.rodovia as rodovia_numero',
                'trechos.quilometragem_inicial',
                'trechos.quilometragem_final'
            ])
            ->with([
                'uf:id,sigla,nome',
                'rodovia:id,rodovia,uf_id'
            ])
            ->orderBy('trechos.data_referencia', 'desc');

        // Apply filters if provided
        if ($request->has('uf_id')) {
            $query->where('trechos.uf_id', $request->uf_id);
        }

        if ($request->has('rodovia_id')) {
            $query->where('trechos.rodovia_id', $request->rodovia_id);
        }

        if ($request->has('tipo_trecho')) {
            $query->where('trechos.tipo_trecho', $request->tipo_trecho);
        }

        // Paginate the results
        $perPage = $request->get('per_page', 10);  // Default to 10 items per page
        $trechos = $query->paginate($perPage);

        return response()->json($trechos);
    }

    public function deleteTrecho($id)
    {
        $trecho = Trecho::find($id);

        if (!$trecho) {
            return response()->json([
                'message' => 'Trecho not found'
            ], 404);
        }

        $trecho->delete();

        return response()->json([
            'message' => 'Trecho deleted successfully'
        ], 200);
    }

    public function edit($id)
    {
        $trecho = Trecho::findOrFail($id);
        return Inertia::render('EditTrecho', [
            'trecho' => $trecho,
        ]);
    }

    public function update(Request $request)
    {
        $trecho = Trecho::findOrFail($request->id);
        $trecho->update($request->all());
        
        return response()->json(['success' => true]);
    }
}
