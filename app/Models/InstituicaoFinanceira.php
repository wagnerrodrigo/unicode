<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituicaoFinanceira extends Model
{
    use HasFactory;
    protected $table = 'instituicao_financeira';

    protected $fillable = [
        'instituicao_financeira',
        'numero_conta',
        'digito_conta',
        'agencia',
        'tipo_conta',
        'titular',
        'situacao',
        'razao_social',
        'descricao',
        'data_fim'
    ];
}
