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
            ->join('intranet.status_despesa', 'intranet.status_despesa.id_status_despesa', '=', 'intranet.tab_despesa.fk_status_despesa_id')
            ->join('intranet.tab_parcela_despesa', 'intranet.tab_parcela_despesa.fk_despesa', '=', 'intranet.tab_despesa.id_despesa')
            ->distinct('id_despesa')
            ->where('intranet.tab_despesa.fk_tab_centro_custo_id', '!=', null);

        if ($dt_inicio && $dt_fim && $status_despesa_id) {
            $lancamentos = $query
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->whereRaw("intranet.tab_despesa.dt_inicio >= ? and intranet.tab_despesa.dt_inicio <= ?", [$dt_inicio, $dt_fim])->paginate(10);
        } else if ($dt_inicio && $dt_fim && !$status_despesa_id) {
            $lancamentos = $query
                ->whereRaw('(intranet.tab_despesa.fk_status_despesa_id = 6 or intranet.tab_despesa.fk_status_despesa_id = 4)')
                ->whereRaw("intranet.tab_despesa.dt_inicio >= ? and intranet.tab_despesa.dt_inicio <= ?", [$dt_inicio, $dt_fim])->paginate(10);
        } else if ($status_despesa_id && !$dt_inicio && !$dt_fim) {
            $lancamentos = $query->where('intranet.tab_despesa.fk_status_despesa_id', '=', $status_despesa_id)
                ->paginate(10);
        } else {
            $lancamentos = $query
                ->where('intranet.tab_despesa.fk_status_despesa_id', '=', 6)
                ->orWhere('intranet.tab_despesa.fk_status_despesa_id', '=', 4)->orderBy('intranet.tab_despesa.id_despesa', 'desc')
                ->paginate($results);
        }
        return $lancamentos;
    }

    static function findOne($id)
    {
        return DB::table('intranet.tab_lancamento')
            ->join('intranet.tab_parcela_despesa', 'intranet.tab_lancamento.fk_tab_parcela_despesa_id', '=', 'intranet.tab_parcela_despesa.id_parcela_despesa')
            ->join('intranet.tab_despesa', 'intranet.tab_parcela_despesa.fk_despesa', '=', 'intranet.tab_despesa.id_despesa')
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

    //BUsca/Filtro de LANÇAMENTOS DISPONIVEIS PARA CONCILIAÇÃO da tela EXTRATO
    static function findByStatus($id_status = null ,$dt_lancamento = null, $dt_vencimento = null, $n_conta = null)
    {
        $data = DB::table('intranet.tab_lancamento')
        ->join(
            'intranet.tab_parcela_despesa',
            'id_parcela_despesa',
            '=',
            'intranet.tab_lancamento.fk_tab_parcela_despesa_id'
        )->join(
            'intranet.status_despesa',
            'id_status_despesa',
            '=',
            'intranet.tab_parcela_despesa.fk_status_id'
        )->join(
            'intranet.tab_rateio_pagamento',
            'fk_tab_lancamento',
            '=',
            'id_tab_lancamento'
        )->join(
            'intranet.tab_conta_bancaria',
            'fk_tab_conta_bancaria',
            '=',
            'id_conta_bancaria'
        )->join(
            'intranet.tab_inst_banco',
            'id',
            '=',
            'fk_tab_inst_banco_id'
        )
        
   
        ->where("intranet.tab_parcela_despesa.fk_status_id", "=", $id_status);

        if($dt_lancamento && $dt_vencimento && $n_conta){
            $lancamentos = $data
            ->where('intranet.tab_parcela_despesa.fk_status_id', '=', StatusDespesa::PROVISIONADO)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '>=', $dt_lancamento)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '<=', $dt_vencimento)
            ->where('intranet.tab_conta_bancaria.nu_conta', '=', $n_conta)
            ->orderBy('intranet.tab_lancamento.fk_tab_parcela_despesa_id', 'desc')
            ->paginate(10);
        }else if($dt_lancamento && $dt_vencimento){
            $lancamentos = $data
            ->where('intranet.tab_parcela_despesa.fk_status_id', '=', StatusDespesa::PROVISIONADO)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '>=', $dt_lancamento)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '<=', $dt_vencimento)
            ->orderBy('intranet.tab_lancamento.fk_tab_parcela_despesa_id', 'desc')
            ->paginate(10);
        }else if($n_conta){
            $lancamentos = $data
            ->where('intranet.tab_parcela_despesa.fk_status_id', '=', StatusDespesa::PROVISIONADO)
            ->where('intranet.tab_conta_bancaria.nu_conta', '=', $n_conta)
            ->orderBy('intranet.tab_lancamento.fk_tab_parcela_despesa_id', 'desc')
            ->paginate(10);
        }else{
            $lancamentos = $data
            ->orderBy('intranet.tab_lancamento.id_tab_lancamento', 'desc')
            ->paginate(10);
        }
        
        return $lancamentos;
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
            fk_tab_parcela_despesa_id,
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
            $lancamento->id_parcela_despesa,
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

    //Filtro LANÇAMENTOS DISPONIVEIS PARA CONCILIAÇÃO / EXTRATO
    static function findByPeriod($dt_lancamento, $dt_vencimento)
    {
        $query = DB::table('intranet.tab_lancamento')

            ->join(
                'intranet.tab_parcela_despesa', 
                'intranet.tab_parcela_despesa.id_parcela_despesa', 
                '=', 
                'intranet.tab_lancamento.fk_tab_parcela_despesa_id')
            ->join(
                'intranet.status_despesa',
                'id_status_despesa',
                '=',
                'intranet.tab_parcela_despesa.fk_status_id'
            )->join(
                'intranet.tab_rateio_pagamento',
                'fk_tab_lancamento',
                '=',
                'id_tab_lancamento'
            )->join(
                'intranet.tab_conta_bancaria',
                'fk_tab_conta_bancaria',
                '=',
                'id_conta_bancaria')

            ->where('intranet.tab_parcela_despesa.fk_status_id', '=', StatusDespesa::PROVISIONADO)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '>=', $dt_lancamento)
            ->where('intranet.tab_lancamento.dt_efetivo_pagamento', '<=', $dt_vencimento)
            ->orderBy('intranet.tab_lancamento.fk_tab_parcela_despesa_id', 'desc')
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

    static function updateExpenceBasedOnInstallmet($id_despesa){
        $query = (
            "UPDATE tab_despesa A
             SET fk_status_despesa_id = 1
            WHERE
                id_despesa = '". $id_despesa ."'AND
                qt_parcelas_despesa =
                (SELECT COUNT(1) FROM tab_parcela_despesa B
            WHERE B.fk_status_id IN (1) AND fk_despesa = '". $id_despesa ."');");
            // dd($query);
              DB::table($query);
    }
}
