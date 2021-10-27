<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaBancaria extends Model
{
    use HasFactory;

    protected $table = 'contas_bancarias';

    protected $fillable = [
        'instituicao_bancaria',
        'numero_conta',
        'digito_conta',
        'agencia',
        'tipo_conta',
        'titular',
        'situacao',
        'descricao',
        'data_fim'
    ];
}
