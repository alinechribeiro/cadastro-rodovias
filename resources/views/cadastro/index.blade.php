@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Cadastro de Trecho</h1>

    <form action="{{ route('cadastro.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Data de Referência -->
        <div>
            <label for="data_referencia" class="block text-sm font-medium">Data de Referência</label>
            <input type="date" name="data_referencia" id="data_referencia" required class="mt-1 block w-full p-2 border rounded-md">
        </div>

        <!-- Unidade da Federação -->
        <div>
            <label for="uf_id" class="block text-sm font-medium">Unidade da Federação</label>
            <select name="uf_id" id="uf_id" required class="mt-1 block w-full p-2 border rounded-md">
                @foreach($ufs as $uf)
                    <option value="{{ $uf->id }}">{{ $uf->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Rodovia -->
        <div>
            <label for="rodovia_id" class="block text-sm font-medium">Rodovia</label>
            <select name="rodovia_id" id="rodovia_id" required class="mt-1 block w-full p-2 border rounded-md">
                @foreach($rodovias as $rodovia)
                    <option value="{{ $rodovia->id }}">{{ $rodovia->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tipo de Trecho -->
        <div>
            <label for="tipo_trecho" class="block text-sm font-medium">Tipo de Trecho</label>
            <select name="tipo_trecho" id="tipo_trecho" required class="mt-1 block w-full p-2 border rounded-md">
                <option value="B1">B1</option>
                <option value="B2">B2</option>
                <option value="B3">B3</option>
            </select>
        </div>

        <!-- Quilometragem Inicial -->
        <div>
            <label for="km_inicial" class="block text-sm font-medium">Quilometragem Inicial</label>
            <input type="number" name="km_inicial" id="km_inicial" required class="mt-1 block w-full p-2 border rounded-md">
        </div>

        <!-- Quilometragem Final -->
        <div>
            <label for="km_final" class="block text-sm font-medium">Quilometragem Final</label>
            <input type="number" name="km_final" id="km_final" required class="mt-1 block w-full p-2 border rounded-md">
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Cadastrar</button>
        </div>
    </form>
</div>
@endsection
