<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lancamento extends Model
{
    use HasFactory;

    static function selectAll($dt_inicio = null, $dt_fim = null, $status_despesa_id = null)
    {
        $query = DB::table('intranet.tab_despesa')
            ->join('intranet.status_despesa', 'intranet.status_despesa.id_status_despesa', '=', 'intranet.tab_despesa.fk_status_despesa_id');

        if ($dt_inicio && $dt_fim && $status_despesa_id) {
            $lancamentos = $query
                ->whereBetween('intranet.tab_despesa.dt_vencimento', [$dt_inicio, $dt_fim])
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->paginate(10);
        } else if ($dt_inicio && $dt_fim && !$status_despesa_id) {
            $lancamentos = $query->whereBetween('intranet.tab_despesa.dt_vencimento', [$dt_inicio, $dt_fim])
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', 6)
                ->orWhere('intranet.tab_despesa.fk_status_despesa_id', '=', 4)
                ->paginate(10);
        } else if ($status_despesa_id && !$dt_inicio && !$dt_fim) {
            $lancamentos = $query->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->paginate(10);
        } else {
            $lancamentos = $query->where('intranet.tab_despesa.fk_status_despesa_id', '=', 6)
                ->orWhere('intranet.tab_despesa.fk_status_despesa_id', '=', 4)->paginate(10);
        }
        return $lancamentos;
    }

    static function findOne($id)
    {
        $data = DB::select("SELECT lancamento.id_tab_lancamento,
        lancamento.fk_condicao_pagamento_id,
        lancamento.dt_vencimento,
        lancamento.dt_fim,
        despesa.id_despesa,
        despesa.fk_tab_centro_custo_id,
	    despesa.fk_status_despesa_id,
        status_dep.de_status_despesa,
        despesa.de_despesa,
        despesa.valor_total_despesa,
        despesa.dt_vencimento,
        despesa.dt_provisionamento,
        empresa.id_empresa,
        empresa.de_empresa,
        pagamento.fk_tab_lancamento_id,
        pagamento.de_pagamento
        FROM intranet.tab_lancamento AS lancamento
        RIGHT JOIN intranet.tab_despesa AS despesa ON (lancamento.fk_tab_despesa_id = despesa.id_despesa)
        LEFT JOIN intranet.tab_pagamento AS pagamento ON (despesa.id_despesa = pagamento.fk_tab_lancamento_id)
        INNER JOIN intranet.tab_centro_custo as centroCusto on (despesa.fk_tab_centro_custo_id = centroCusto.id_centro_custo)
        INNER JOIN intranet.status_despesa as status_dep on (despesa.fk_status_despesa_id = status_dep.id_status_despesa)
        INNER JOIN intranet.tab_empresa as empresa on (centroCusto.fk_empresa_id = empresa.id_empresa)
        WHERE despesa.id_despesa = ?;", [$id]);

        $lancamento = $data[0];

        return $lancamento;
    }


    static function showInfoAccount($info)
    {
        $query =  DB::select("SELECT
                 id, co_banco, de_banco
                 FROM intranet.intranet.tab_inst_banco
                 WHERE id = ?;", [$info]);

        return $query;
    }


    static function showInfoAgency($id)
    {
        $query = DB::select("SELECT conta_banco.id_conta_bancaria,
                   conta_banco.fk_tab_inst_banco_id,
                   conta_banco.nu_agencia
                   fROM intranet.tab_conta_bancaria AS conta_banco
                   JOIN intranet.tab_inst_banco AS ins_bank ON(ins_bank.id = conta_banco.fk_tab_inst_banco_id)
                   WHERE conta_banco.id_conta_bancaria = ?;", [$id]);

        return $query;
    }

    static function showInfoBankAccount($id)
    {
        $query = DB::select("SELECT
                    conta_banco.fk_tab_inst_banco_id,
                    conta_banco.nu_conta
                    FROM intranet.tab_conta_bancaria AS conta_banco
                    JOIN intranet.tab_inst_banco AS ins_bank ON(ins_bank.id = conta_banco.fk_tab_inst_banco_id)
                    WHERE conta_banco.id_conta_bancaria = ?", [$id]);

        return $query;
    }

    static function showDataProvidedEmployee($id)
    {
        $query = DB::select(" SELECT
                a.fk_tab_inst_banco_id,
                b.de_banco,
                a.nu_agencia,
                a.nu_conta,
                a.fk_tab_empregado_id,
                c.id_despesa
                FROM
                intranet.intranet.tab_conta_bancaria a
                INNER JOIN
                intranet.intranet.tab_inst_banco b ON (a.fk_tab_inst_banco_id = b.id)
                INNER JOIN
                intranet.intranet.tab_despesa c ON (a.fk_tab_empregado_id = c.fk_tab_empregado_id)
                WHERE c.id_despesa = ?;", [$id]);

        return $query;
    }

    static function findByInitialPeriod($id_incio, $id_fim)
    {
        $query = DB::select("SELECT *
                FROM intranet.tab_despesa AS despesas
                WHERE date_trunc('day',despesas.dt_inicio) >=('$id_incio')
                AND   date_trunc('day',despesas.dt_inicio) <= ('$id_fim');");

        return $query;
    }

    static function findCompanyAccountBank($id)
    {
        $query = DB::select("SELECT conta_bancaria.fk_tab_empresa_id,
		conta_bancaria.id_conta_bancaria,
        conta_bancaria.nu_agencia,
        conta_bancaria.nu_conta,
       	conta_bancaria.fk_tab_inst_banco_id,
        conta_bancaria.fk_tab_fornecedor_id,
        conta_bancaria.co_op,
        banco.co_banco,
        banco.de_banco
        FROM intranet.tab_conta_bancaria as conta_bancaria
        inner join intranet.tab_inst_banco as banco on (banco.id = conta_bancaria.fk_tab_inst_banco_id)
        where conta_bancaria.fk_tab_empresa_id = ?", [$id]);

        return $query;
    }


    static function findByStatus($id_status)
    {
        $data = DB::table('intranet.tab_lancamento')->join(
            'intranet.tab_despesa',
            'id_despesa',
            '=',
            'intranet.tab_lancamento.fk_tab_despesa_id'
        )->join(
            'intranet.status_despesa',
            'id_status_despesa',
            '=',
            'intranet.tab_despesa.fk_status_despesa_id'
        )->where("intranet.tab_despesa.fk_status_despesa_id", "=", $id_status)->paginate(10);

        return $data;
    }

    static function findPaymentCondition()
    {
        $data = DB::table('intranet.tab_lancamento')->join(
            'intranet.tab_rateio_pagamento',
            'id_rateio_pagamento', '=', 'intranet.tab_lancamento.fk_tab_lancamento'
        );

        return $data;
        
    }

    static function create($lancamento)
    {
        DB::insert("INSERT INTO intranet.tab_lancamento
        (
            fk_tab_despesa_id,
            fk_condicao_pagamento_id,
            dt_inicio,
            dt_fim
        )
        VALUES(?, ?, ?, ?)", [
            $lancamento->id_despesa,
            $lancamento->fk_condicao_pagamento_id,
            $lancamento->dt_inicio,
            $lancamento->dt_fim
        ]);
    }

    static function findIdByTimeStamp($timestamp){
        return DB::select("SELECT id_tab_lancamento FROM intranet.tab_lancamento WHERE dt_inicio = ?", [$timestamp]);
    }
   
}
