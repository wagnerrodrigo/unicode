<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanoConta extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'codigo',
        'nome',
        'descricao',
        'valor_unitario'
    ];
}
