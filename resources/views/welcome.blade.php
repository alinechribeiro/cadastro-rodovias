<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Trecho</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: white;">
    <div class="container">
        <h1>Formulário de Trecho</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="data_referencia">Data de Referência:</label>
                <input type="date" class="form-control" id="data_referencia" name="data_referencia" required>
            </div>

            <div class="form-group">
                <label for="uf">Unidade da Federação:</label>
                <select class="form-control" id="uf" name="uf" required>
                    <option value="" disabled selected>Selecione a UF</option>
                    @foreach($ufs as $uf)
                        <option value="{{ $uf->id }}">{{ $uf->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rodovia">Rodovia:</label>
                <select class="form-control" id="rodovia" name="rodovia" required>
                    <option value="" disabled selected>Selecione a Rodovia</option>
                    @foreach($rodovias as $rodovia)
                        <option value="{{ $rodovia->id }}">{{ $rodovia->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_trecho">Tipo de Trecho:</label>
                <select class="form-control" id="tipo_trecho" name="tipo_trecho" required>
                    <option value="" disabled selected>Selecione o Tipo de Trecho</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="km_inicial">Quilometragem Inicial:</label>
                <input type="number" class="form-control" id="km_inicial" name="km_inicial" required>
            </div>

            <div class="form-group">
                <label for="km_final">Quilometragem Final:</label>
                <input type="number" class="form-control" id="km_final" name="km_final" required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>
</html>
