<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model 
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nome_fantasia',
        'razao_social',
        'inscricao_estadual',
        'cnpj',
        'tipo_pessoa',
        'telefone',
        'email',
        'email_secundario',
        'ponto_contato',
        'cargo_funcao',
        'ramo_atuacao',
        'data_fim'
    ];
}
