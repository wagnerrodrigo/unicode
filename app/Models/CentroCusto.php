<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCusto extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa',
        'nome',
        'responsavel',
        'data_fim',
    ];
}
