<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UF extends Model
{
    use HasFactory;

    // Caso a tabela tenha um nome diferente de 'ufs', especifique-o aqui
    protected $table = 'ufs';

    // Defina quais campos são atribuíveis em massa
    protected $fillable = [
        'nome',
        'sigla',
    ];

    /**
     * Find a UF by its sigla (abbreviation).
     *
     * @param string $sigla
     * @return UF|null
     */
    public static function findBySigla($sigla)
    {
        return self::where('sigla', $sigla)->first();
    }
}
