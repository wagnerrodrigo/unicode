<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rateio extends Model
{
    use HasFactory;

    protected $fillable = [
        "valor_rateio_despesa",
        "porcentagem_rateio_despesa",
        "fk_tab_centro_custo_id",
        "fk_tab_item_despesa",
        "dt_inicio",
        "dt_fim",
    ];

    static function create($rateio)
    {
        DB::insert("INSERT INTO intranet.tab_rateio_despesa
        (valor_rateio_despesa, porcentagem_rateio_despesa, fk_tab_centro_custo_id, fk_tab_item_despesa, dt_inicio, dt_fim, fk_tab_despesa)
        VALUES(?, ?, ?, ?, ?, ?, ?);
        ", [
            $rateio->valor_rateio_despesa,
            $rateio->porcentagem_rateio_despesa,
            $rateio->fk_tab_centro_custo_id,
            $rateio->fk_tab_item_despesa,
            $rateio->dt_inicio,
            $rateio->dt_fim,
            $rateio->fk_tab_despesa
        ]);
    }

    static function createRateioLancamento($rateio)
    {
        DB::insert("INSERT INTO intranet.tab_rateio_pagamento
        (valor_rateio_pagamento, fk_tab_conta_bancaria, fk_tab_lancamento, dt_inicio, dt_fim)
        VALUES(?, ?, ?, ?, ?)
        ", [
            $rateio->valor_rateio_pagamento,
            $rateio->fk_tab_conta_bancaria,
            $rateio->fk_tab_lancamento,
            $rateio->dt_inicio,
            $rateio->dt_fim
        ]);
    }

    static function getRateioLancamento($id)
    {
        return DB::table('intranet.tab_rateio_pagamento')
            ->join('intranet.tab_conta_bancaria', 'tab_rateio_pagamento.fk_tab_conta_bancaria', '=', 'tab_conta_bancaria.id_conta_bancaria')
            ->join('intranet.tab_inst_banco', 'intranet.tab_conta_bancaria.fk_tab_inst_banco_id', '=', 'intranet.tab_inst_banco.id')
            ->join('intranet.tab_empresa', 'intranet.tab_conta_bancaria.fk_tab_empresa_id', '=', 'intranet.tab_empresa.id_empresa')
            ->where('fk_tab_lancamento', '=', $id)
            ->get();
    }

    static function getContaBancariaRateioByLancamento($id)
    {
        return DB::table('intranet.tab_rateio_pagamento')->select(
            "id_conta_bancaria",
            "nu_agencia",
            "nu_conta",
            "de_banco",
            "valor_rateio_pagamento"
        )
            ->join('intranet.tab_conta_bancaria', 'tab_rateio_pagamento.fk_tab_conta_bancaria', '=', 'tab_conta_bancaria.id_conta_bancaria')
            ->join('intranet.tab_inst_banco', 'tab_conta_bancaria.fk_tab_inst_banco_id', '=',  'intranet.tab_inst_banco.id')
            ->where('fk_tab_lancamento', '=', $id)
            ->get();
    }

    static function del($id_despesa, $end_date)
    {
        DB::update("UPDATE intranet.tab_rateio_despesa
        SET dt_fim = ?
        WHERE fk_tab_despesa = ?", [$end_date, $id_despesa]);
    }

    static function getRateioDespesa($id)
    {
        return DB::table('intranet.tab_rateio_despesa')
            ->join(
                "intranet.tab_centro_custo",
                "tab_rateio_despesa.fk_tab_centro_custo_id",
                "=",
                "tab_centro_custo.id_centro_custo"
            )->join(
                "intranet.tab_departamento",
                "intranet.tab_departamento.id_departamento",
                "=",
                "intranet.tab_centro_custo.fk_tab_departamento"
            )->join(
                "intranet.tab_empresa",
                "intranet.tab_empresa.id_empresa",
                "=",
                "intranet.tab_centro_custo.fk_empresa_id"
            )->where("fk_tab_despesa", "=", $id)->get();
    }
}


/* select * from intranet.tab_rateio_despesa as rateio
inner join intranet.intranet.tab_centro_custo tcc on tcc.id_centro_custo  = rateio.fk_tab_centro_custo_id
inner join intranet.tab_departamento td on td.id_departamento = tcc.fk_tab_departamento
inner join intranet.intranet.tab_empresa te on te.id_empresa = tcc.fk_empresa_id
where rateio.fk_tab_despesa = 18206 */
