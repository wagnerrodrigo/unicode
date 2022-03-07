<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Utils\TipoDespesa;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pagamento',
        'de_pagamento',
        'fk_tab_lancamento_id',
        'dt_inicio',
        'dt_fim',
        'fk_rateio_pagamento',
        'fk_tab_conciliacao'

    ];

    static function selectAll()
    {
        $pagamento = DB::table('intranet.tab_pagamento')
            ->join(
                'intranet.tab_lancamento',
                'tab_lancamento.id_tab_lancamento',
                '=',
                'tab_pagamento.fk_tab_lancamento_id'
            )
            ->join(
                'intranet.tab_despesa',
                'tab_lancamento.fk_tab_despesa_id',
                '=',
                'tab_despesa.id_despesa'
            )->join(
                'intranet.status_despesa',
                'tab_despesa.fk_status_despesa_id',
                '=',
                'status_despesa.id_status_despesa'
            )->get();
        return $pagamento;
    }

    static function findOne($id)
    {
        return DB::table('intranet.tab_pagamento')
            ->join(
                'intranet.tab_lancamento',
                'tab_lancamento.id_tab_lancamento',
                '=',
                'tab_pagamento.fk_tab_lancamento_id'
            )
            ->where("intranet.tab_pagamento.id_pagamento", "=", $id)->get();
    }

    //mostra todos os dados dos pagamentos
    static function getInfosPagamento($id, $tipoDespesa)
    {
        $query = DB::table('intranet.tab_pagamento')
            ->join(
                'intranet.tab_lancamento',
                'tab_lancamento.id_tab_lancamento',
                '=',
                'tab_pagamento.fk_tab_lancamento_id'
            )->join(
                'intranet.tab_despesa',
                'tab_lancamento.fk_tab_despesa_id',
                '=',
                'tab_despesa.id_despesa'
            )->join(
                'intranet.status_despesa',
                'tab_despesa.fk_status_despesa_id',
                '=',
                'status_despesa.id_status_despesa'
            )->join(
                'intranet.tab_centro_custo',
                'tab_despesa.fk_tab_centro_custo_id',
                '=',
                'tab_centro_custo.id_centro_custo'
            )->join(
                "intranet.tab_empresa",
                "tab_centro_custo.fk_empresa_id",
                "=",
                "tab_empresa.id_empresa"
            )->join(
                'intranet.tab_departamento',
                'tab_departamento.id_departamento',
                '=',
                'tab_centro_custo.fk_tab_departamento'
            )->join(
                "intranet.tab_rateio_pagamento",
                "tab_rateio_pagamento.fk_tab_lancamento",
                "=",
                "id_tab_lancamento"
            )->join(
                "intranet.tab_conta_bancaria",
                "tab_rateio_pagamento.fk_tab_conta_bancaria",
                "=",
                "tab_conta_bancaria.id_conta_bancaria"
            )->join(
                "intranet.tab_inst_banco",
                "tab_inst_banco.id",
                "=",
                "tab_conta_bancaria.fk_tab_inst_banco_id"
            );

        if ($tipoDespesa == TipoDespesa::FORNECEDOR) {
            $query->join(
                'intranet.tab_fornecedor',
                'tab_despesa.fk_tab_fornecedor_id',
                '=',
                'tab_fornecedor.id_fornecedor'
            );
        } else {
            $query->join(
                'intranet.tab_empregado',
                'tab_despesa.fk_tab_empregado_id',
                '=',
                'tab_empregado.id_empregado'
            );
        }

        return $query->where("intranet.tab_pagamento.id_pagamento", "=", $id)->get();
    }

    static function create($pagamento)
    {
        DB::insert("INSERT INTO intranet.tab_pagamento
        (
        fk_tab_lancamento_id,
        dt_inicio,
        dt_fim,
        fk_rateio_pagamento,
        fk_tab_conciliacao
        )
        VALUES(?, ?, ?, ?, ?)", [
            $pagamento->fk_tab_lancamento_id,
            $pagamento->dt_inicio,
            $pagamento->dt_fim,
            $pagamento->fk_rateio_pagamento,
            $pagamento->fk_tab_conciliacao
        ]);
    }
}
