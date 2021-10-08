<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setor',
        'empresa',
        'fornecedor',
        'descricao_do_servico',
        'local',
        'status',
        'obs',
        'data_inicio',
        'data_fim',
        'data_assinatura',
        'valor_contrato',
        'dia_pagamento',
        'juros_multa_atraso',
        'multa_recisoria',
        'pdf_documento',
        'diretor_assinante',
        'diretor_autorizador',
        'prazo_vigencia',
        'forma_de_pagamento',
        'carencia',
        'nome_representante',
        'telefone_representante',
        'recisao_antecipada',
        'prazo_recisao',
    ];
}
