<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trecho extends Model
{
    use HasFactory;

    protected $table = 'trechos';

    protected $fillable = [
        'data_referencia',
        'uf_id',
        'rodovia_id',
        'tipo_trecho',
        'quilometragem_inicial',
        'quilometragem_final',
        'geo',
    ];

    /**
     * Relacionamento com o model UF
     */
    public function uf()
    {
        return $this->belongsTo(UF::class);
    }

    /**
     * Relacionamento com o model Rodovia
     */
    public function rodovia()
    {
        return $this->belongsTo(Rodovia::class);
    }
}
