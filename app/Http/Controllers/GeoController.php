<?php

namespace App\Http\Controllers;

use App\Models\UF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoController extends Controller
{
    public function processGeoData(Request $request)
    {
        $validatedData = $request->validate([
            'br' => 'required|string',
            'tipo' => 'required|string',
            'uf' => 'required|string',
            'cd_tipo' => 'nullable|string',
            'data' => 'required|date',
            'kmi' => 'required|numeric',
            'kmf' => 'required|numeric',
        ]);

        try {
            $response = Http::get('https://servicos.dnit.gov.br/sgplan/apigeo/rotas/espacializarlinha', $validatedData);

            if ($response->successful()) {
                // Extract the geometry from the API response
                $geometry = $response->json() ?? null;

                // Combine the validated data with the geometry field
                $combinedData = [
                    'br' => $validatedData['br'],
                    'uf_id' => UF::findBySigla($validatedData['uf'])->id,
                    'cd_tipo' => $validatedData['cd_tipo'],
                    'data_referencia' => $validatedData['data'],
                    'km_inicial' => $validatedData['kmi'],
                    'km_final' => $validatedData['kmf'],
                    'geo' => $geometry,
                ];

                $trecho = new TrechoController();

                return $trecho->store($combinedData);
            } else {
                return response()->json(['error' => 'Erro na API do DNIT'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao processar a requisição: ' . $e->getMessage()], 500);
        }
    }

}
