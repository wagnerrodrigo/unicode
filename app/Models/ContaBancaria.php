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
        'nu_conta',
        'agencia',
        'fk_tab_inst_banco_id',
        'fk_tab_fornecedor_id',
        'fk_tab_empregado_id',
        'fk_tab_empresa_id',
        'dt_inicio',
        'dt_fim',
        'co_op'
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

    static function create($contaBancaria)
    {
        DB::insert("INSERT INTO intranet.tab_conta_bancaria
        (
            nu_agencia,
            nu_conta,
            fk_tab_inst_banco_id,
            fk_tab_fornecedor_id,
            fk_tab_empregado_id,
            fk_tab_empresa_id,
            dt_inicio,
            dt_fim,
            co_op
        ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $contaBancaria->nu_agencia,
            $contaBancaria->nu_conta,
            $contaBancaria->fk_tab_inst_banco_id,
            $contaBancaria->fk_tab_fornecedor_id,
            $contaBancaria->fk_tab_empregado_id,
            $contaBancaria->fk_tab_empresa_id,
            $contaBancaria->dt_inicio,
            $contaBancaria->dt_fim,
            $contaBancaria->co_op
        ]);
    }
}
