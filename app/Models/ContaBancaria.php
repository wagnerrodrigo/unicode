<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    static function getContaBancariaFornecedor($id)
    {
        return DB::select("SELECT
        conta_bancaria.id_conta_bancaria,
        conta_bancaria.nu_agencia,
        conta_bancaria.nu_conta,
       	conta_bancaria.fk_tab_inst_banco_id,
        conta_bancaria.fk_tab_fornecedor_id,
        conta_bancaria.co_op,
        banco.co_banco,
        banco.de_banco
        FROM intranet.tab_conta_bancaria as conta_bancaria
        inner join intranet.tab_inst_banco as banco on banco.id = conta_bancaria.fk_tab_inst_banco_id
        where conta_bancaria.fk_tab_fornecedor_id = $id");
    }
}
