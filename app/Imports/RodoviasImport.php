<?php

namespace App\Imports;

use App\Models\Rodovia;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RodoviasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Rodovia([
            'id' => $row['id'],
            'uf_id' => $row['uf_id'],
            'rodovia' => $row['rodovia'],
        ]);
    }
}

