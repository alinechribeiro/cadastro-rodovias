<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodovia extends Model
{
    use HasFactory;

    protected $table = 'rodovias';

    protected $fillable = ['id', 'uf_id', 'rodovia'];

    public function uf()
    {
        return $this->belongsTo(UF::class);
    }
}