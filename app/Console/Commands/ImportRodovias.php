<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RodoviasImport;

class ImportRodovias extends Command
{
    protected $signature = 'import:rodovias {file}';

    protected $description = 'Importa os dados das rodovias a partir de um arquivo CSV';

    public function handle()
    {
        $file = $this->argument('file');

        Excel::import(new RodoviasImport, $file);

        $this->info('Importação concluída com sucesso!');
    }
}
