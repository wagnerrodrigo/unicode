<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Utils\StatusDespesa;

class Lancamento extends Model
{
    use HasFactory;

    static function selectAll($results = 10, $dt_inicio = null, $dt_fim = null, $status_despesa_id = null)
    {
        $query = DB::table('intranet.tab_despesa')
            ->join('intranet.status_despesa', 'intranet.status_despesa.id_status_despesa', '=', 'intranet.tab_despesa.fk_status_despesa_id');

        if ($dt_inicio && $dt_fim && $status_despesa_id) {
            $lancamentos = $query
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->whereRaw("intranet.tab_despesa.dt_vencimento >= ? and intranet.tab_despesa.dt_vencimento <= ?", [$dt_inicio, $dt_fim])->paginate(10);
        } else if ($dt_inicio && $dt_fim && !$status_despesa_id) {
            $lancamentos = $query
                ->whereRaw('(intranet.tab_despesa.fk_status_despesa_id = 6 or intranet.tab_despesa.fk_status_despesa_id = 4)')
                ->whereRaw("intranet.tab_despesa.dt_vencimento >= ? and intranet.tab_despesa.dt_vencimento <= ?", [$dt_inicio, $dt_fim])->paginate(10);
        } else if ($status_despesa_id && !$dt_inicio && !$dt_fim) {
            $lancamentos = $query->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->paginate(10);
        } else {
            $lancamentos = $query->where('intranet.tab_despesa.fk_tab_centro_custo_id', '!=', null)
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', 6)
                ->orWhere('intranet.tab_despesa.fk_status_despesa_id', '=', 4)->orderBy('intranet.status_despesa.de_status_despesa', 'asc')
                ->paginate($results);
        }
        return $lancamentos;
    }

    static function findOne($id)
    {
        return DB::table('intranet.tab_lancamento')
            ->rightJoin('intranet.tab_despesa', 'intranet.tab_lancamento.fk_tab_despesa_id', '=', 'intranet.tab_despesa.id_despesa')
            ->join('intranet.tab_centro_custo', 'intranet.tab_despesa.fk_tab_centro_custo_id', '=', 'intranet.tab_centro_custo.id_centro_custo')
            ->join('intranet.status_despesa', 'intranet.status_despesa.id_status_despesa', '=', 'intranet.tab_despesa.fk_status_despesa_id')
            ->join('intranet.tab_empresa', 'intranet.tab_empresa.id_empresa', '=', 'intranet.tab_centro_custo.fk_empresa_id')
            ->where('intranet.tab_lancamento.id_tab_lancamento', '=', $id)
            ->get();
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
        )->where("intranet.tab_despesa.fk_status_despesa_id", "=", $id_status)->orderBy('intranet.tab_lancamento.id_tab_lancamento', 'desc')->paginate(10);

        return $data;
    }

    static function findPaymentCondition()
    {
        $data = DB::table('intranet.tab_lancamento')->join(
            'intranet.tab_rateio_pagamento',
            'id_rateio_pagamento',
            '=',
            'intranet.tab_lancamento.fk_tab_lancamento'
        );

        return $data;
    }

    static function create($lancamento)
    {
        DB::insert("INSERT INTO intranet.tab_lancamento
        (
            fk_tab_despesa_id,
            dt_lancamento,
            dt_vencimento,
            dt_inicio,
            dt_efetivo_pagamento,
            juros,
            multa,
            desconto,
            valor_pago,
            dt_fim
        )
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $lancamento->id_despesa,
            $lancamento->dt_lancamento,
            $lancamento->dt_vencimento,
            $lancamento->dt_inicio,
            $lancamento->dt_efetivo_pagamento,
            $lancamento->juros,
            $lancamento->multa,
            $lancamento->desconto,
            $lancamento->valor_pago,
            $lancamento->dt_fim
        ]);
    }

    static function findIdByTimeStamp($timestamp)
    {
        return DB::select("SELECT id_tab_lancamento FROM intranet.tab_lancamento WHERE dt_inicio = ?", [$timestamp]);
    }

    static function findByPeriod($dt_lancamento, $dt_vencimento)
    {

        $query = DB::table('intranet.tab_lancamento')
            ->join('intranet.tab_despesa', 'intranet.tab_despesa.id_despesa', '=', 'intranet.tab_lancamento.fk_tab_despesa_id')
            ->join('intranet.status_despesa', 'intranet.status_despesa.id_status_despesa', '=', 'intranet.tab_despesa.fk_status_despesa_id')
            ->where('intranet.status_despesa.id_status_despesa', '=', StatusDespesa::PROVISIONADO)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '>=', $dt_lancamento)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '<=', $dt_vencimento)
            ->paginate(10);
        return $query;
    }

    static function deleteLancamento($id, $timestamp)
    {
        DB::table('intranet.tab_lancamento')->where('id_tab_lancamento', '=', $id)
            ->update(['dt_fim' => $timestamp]);
    }

    static function updatePaymentDate($id, $date)
    {
        DB::table('intranet.tab_lancamento')->where('id_tab_lancamento', '=', $id)
            ->update(['dt_efetivo_pagamento' => $date]);
    }
}
