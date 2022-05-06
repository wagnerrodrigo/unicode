<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Utils\TipoDespesa;
use App\Utils\CondicaoPagamentoId;
use App\Utils\StatusDespesa;

class Despesa extends Model
{
    use HasFactory;

    protected $query;
    protected $fillable = [
        'fk_tab_centro_custo_id',
        'fk_tab_tipo_despesa_id',
        'fk_plano_contas',
        'numero_documento_despesa',
        'qt_parcelas_despesa',
        'serie_despesa',
        'dt_emissao',
        'valor_total_despesa',
        'fk_status_despesa_id',
        'fk_tab_fornecedor_id',
        'fk_tab_empregado_id',
        'dt_inicio',
        'dt_fim',
        'de_despesa',
        'dt_vencimento',
        'moeda',
        'dt_provisionamento',
        'fk_condicao_pagamento_id',
        'numero_processo',
        'fk_tab_pix',
        'fk_conta_bancaria',
        'tipo_documento'
    ];

    //Ao passar parametros, se atentar a ordem que é passado na query
    static function selectAll($results, $status = null, $dt_inicio = null, $dt_fim = null, $filial = null)
    {
        //NÚMERO	VALOR	PARCELAS	DATA DE CADASTRO	VENCIMENTO	STATUS
        $query = DB::table('intranet.tab_despesa')
            ->select(
                'tab_despesa.id_despesa',
                'tab_despesa.qt_parcelas_despesa',
                'tab_despesa.dt_inicio',
                'tab_despesa.dt_vencimento',
                'tab_despesa.fk_status_despesa_id',
                'tab_despesa.valor_total_despesa',
                'status_despesa.de_status_despesa',
            )
            ->join(
                'intranet.status_despesa',
                'intranet.status_despesa.id_status_despesa',
                '=',
                'intranet.tab_despesa.fk_status_despesa_id'
            )
            ->where('intranet.tab_despesa.dt_fim', '=', null);

        if ($dt_inicio && $dt_fim && $status && $filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->where("intranet.tab_despesa.dt_vencimento", '>=', "$dt_inicio")
                ->where("intranet.tab_despesa.dt_vencimento", '<=', "$dt_fim")
                ->where("intranet.tab_despesa.fk_empresa_id", '=', "$filial")
                ->orderBy('id_despesa', 'desc')->paginate($results);
        } else if ($dt_inicio && $dt_fim && !$status && $filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.dt_vencimento", '>=', "$dt_inicio")
                ->where("intranet.tab_despesa.dt_vencimento", '<=', "$dt_fim")
                ->where("intranet.tab_despesa.fk_empresa_id", '=', "$filial")
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        } else if (!$dt_inicio && !$dt_fim && $status && $filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->where("intranet.tab_despesa.fk_empresa_id", '=', "$filial")
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        } else if (!$dt_inicio && !$dt_fim && !$status && $filial) {

            $despesas = $query
                ->where("intranet.tab_despesa.fk_empresa_id", '=', "$filial")
                ->orderBy('de_status_despesa', 'desc')
                ->paginate($results);
        } else if ($dt_inicio && $dt_fim && $status && !$filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->where("intranet.tab_despesa.dt_vencimento", '>=', "$dt_inicio")
                ->where("intranet.tab_despesa.dt_vencimento", '<=', "$dt_fim")
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        } else if ($dt_inicio && $dt_fim && !$status && !$filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.dt_vencimento", '>=', "$dt_inicio")
                ->where("intranet.tab_despesa.dt_vencimento", '<=', "$dt_fim")
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        } else if (!$dt_inicio && !$dt_fim && $status && !$filial) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        } else {
            $despesas = $query
                ->orderBy('id_despesa', 'desc')
                ->paginate($results);
        }
        return $despesas;
    }

    static function create($despesa)
    {
        DB::insert("INSERT INTO intranet.tab_despesa
        (fk_tab_centro_custo_id,
        fk_tab_tipo_despesa_id,
        fk_empresa_id,
        fk_plano_contas,
        qt_parcelas_despesa,
        serie_despesa,
        dt_emissao,
        valor_total_despesa,
        fk_status_despesa_id,
        fk_tab_fornecedor_id,
        fk_tab_empregado_id,
        dt_inicio,
        dt_fim,
        de_despesa,
        dt_vencimento,
        moeda,
        dt_provisionamento,
        fk_condicao_pagamento_id,
        numero_processo,
        fk_tab_pix,
        fk_conta_bancaria)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
        ", [

            $despesa->fk_centro_de_custo,
            $despesa->fk_tipo_despesa,
            $despesa->fk_empresa_id,
            $despesa->fk_plano_contas,
            $despesa->qt_parcelas_despesa,
            $despesa->serie_despesa,
            $despesa->dt_emissao,
            $despesa->valor_total_despesa,
            $despesa->fk_status_despesa_id,
            $despesa->fk_tab_fornecedor_id,
            $despesa->fk_tab_empregado_id,
            $despesa->dt_inicio,
            $despesa->dt_fim,
            $despesa->de_despesa,
            $despesa->dt_vencimento,
            $despesa->moeda,
            $despesa->dt_provisionamento,
            $despesa->fk_condicao_pagamento_id,
            $despesa->numero_processo,
            $despesa->fk_tab_pix,
            $despesa->fk_conta_bancaria,
        ]);

        //values(cnpj,razao_social,inscricao_estadual,dt_inicio,dt_fim,nome_fantasia)
    }

    //retorna apenas o id para despesa
    static function findByTimeStamp($timestamp)
    {
        return DB::select("SELECT id_despesa FROM intranet.tab_despesa WHERE dt_inicio = ?", [$timestamp]);
    }

    static function findOne($id, $tipoDespesa = null, $centroCusto = null)
    {
        if ($centroCusto) {
            $query = DB::table('intranet.tab_despesa')->select(
                "tab_despesa.id_despesa",
                "tab_despesa.fk_tab_centro_custo_id",
                "tab_despesa.fk_tab_tipo_despesa_id",
                "tab_despesa.fk_empresa_id",
                "tab_despesa.fk_plano_contas",
                "tab_despesa.fk_status_despesa_id",
                "tab_despesa.fk_tab_fornecedor_id",
                "tab_despesa.fk_tab_empregado_id",
                "tab_plano_contas.fk_tab_clasificacao_contabil_id",
                "tab_plano_contas.fk_tab_de_plano_contas",
                "tab_despesa.qt_parcelas_despesa",
                "tab_despesa.valor_total_despesa",
                "tab_despesa.dt_inicio",
                "tab_despesa.dt_fim",
                "tab_despesa.de_despesa",
                "status_despesa.de_status_despesa",
                "tab_tipo_despesa.de_tipo_despesa",
                "tab_empresa.de_empresa",
                "tab_empresa.regiao_empresa",
                "de_plano_contas.de_plano_contas",
                "tab_clasificacao_contabil.de_clasificacao_contabil",
                "tab_empregado.nome_empregado",
                "tab_empregado.nu_cpf_cnpj",
                "tab_departamento.de_departamento",
            )->join(
                'intranet.status_despesa',
                'intranet.status_despesa.id_status_despesa',
                '=',
                'intranet.tab_despesa.fk_status_despesa_id'
            )->join(
                'intranet.tab_tipo_despesa',
                'intranet.tab_tipo_despesa.id_tipo_despesa',
                '=',
                'intranet.tab_despesa.fk_tab_tipo_despesa_id'
            )->join(
                'intranet.tab_empresa',
                'intranet.tab_empresa.id_empresa',
                '=',
                'intranet.tab_despesa.fk_empresa_id'
            )->join(
                "intranet.tab_plano_contas",
                "intranet.tab_plano_contas.id_plano_contas",
                "=",
                "intranet.tab_despesa.fk_plano_contas"
            )->join(
                "intranet.de_plano_contas",
                "intranet.de_plano_contas.id_de_plano_contas",
                "=",
                "intranet.tab_plano_contas.fk_tab_de_plano_contas"
            )->join(
                "intranet.tab_clasificacao_contabil",
                "intranet.tab_clasificacao_contabil.id_clasificacao_contabil",
                "=",
                "tab_plano_contas.fk_tab_clasificacao_contabil_id"
            )->join(
                    "intranet.tab_centro_custo",
                    "intranet.tab_centro_custo.id_centro_custo",
                    "=",
                    "intranet.tab_despesa.fk_tab_centro_custo_id"
                )
                ->join(
                    "intranet.tab_departamento",
                    "intranet.tab_departamento.id_departamento",
                    "=",
                    "intranet.tab_centro_custo.fk_tab_departamento"
                );
        }else{
            $query = DB::table('intranet.tab_despesa')->join(
                'intranet.status_despesa',
                'intranet.status_despesa.id_status_despesa',
                '=',
                'intranet.tab_despesa.fk_status_despesa_id'
            )->join(
                'intranet.tab_tipo_despesa',
                'intranet.tab_tipo_despesa.id_tipo_despesa',
                '=',
                'intranet.tab_despesa.fk_tab_tipo_despesa_id'
            )->join(
                'intranet.tab_empresa',
                'intranet.tab_empresa.id_empresa',
                '=',
                'intranet.tab_despesa.fk_empresa_id'
            )->join(
                "intranet.tab_plano_contas",
                "intranet.tab_plano_contas.id_plano_contas",
                "=",
                "intranet.tab_despesa.fk_plano_contas"
            )->join(
                "intranet.de_plano_contas",
                "intranet.de_plano_contas.id_de_plano_contas",
                "=",
                "intranet.tab_plano_contas.fk_tab_de_plano_contas"
            )->join(
                "intranet.tab_clasificacao_contabil",
                "intranet.tab_clasificacao_contabil.id_clasificacao_contabil",
                "=",
                "tab_plano_contas.fk_tab_clasificacao_contabil_id"
            );
        }

        if ($tipoDespesa == TipoDespesa::EMPREGADO) {
            $query->leftJoin(
                'intranet.tab_empregado',
                'intranet.tab_empregado.id_empregado',
                '=',
                'intranet.tab_despesa.fk_tab_empregado_id'
            );
        } else if ($tipoDespesa == TipoDespesa::FORNECEDOR) {
            $query->join(
                'intranet.tab_fornecedor',
                'intranet.tab_fornecedor.id_fornecedor',
                '=',
                'intranet.tab_despesa.fk_tab_fornecedor_id'
            );
        } else if ($tipoDespesa == TipoDespesa::MIGRACAO) {
            $query;
        }

        return $query->where('intranet.tab_despesa.id_despesa', '=', "$id")->where('intranet.tab_despesa.dt_fim', '=', null)->get();
    }

    static function set($despesa)
    {
        DB::update("UPDATE intranet.tab_despesa
        SET
            dt_emissao = ?,
            fk_tab_centro_custo_id = ?
        WHERE id_despesa = ?", [
            $despesa->dt_emissao,
            $despesa->fk_tab_centro_custo_id,
            $despesa->id_despesa
        ]);
    }

    static function del($id, $dataFim)
    {
        DB::table('intranet.tab_despesa')
            ->where('id_despesa', '=', $id)
            ->update(['fk_status_despesa_id' => StatusDespesa::CANCELADO, 'dt_fim' => $dataFim]);
    }

    static function setStatus($id_despesa)
    {
        DB::update(
            "UPDATE intranet.tab_despesa
            SET fk_status_despesa_id = 1
            WHERE id_despesa = ?",
            [$id_despesa]
        );
    }

    static function findPaymentConditionById($id)
    {
        return DB::select("SELECT fk_condicao_pagamento_id FROM intranet.tab_despesa WHERE id_despesa =?;", [$id]);
    }
    static function findTipoECentroCustoDespesa($id)
    {
        $query = "SELECT fk_tab_tipo_despesa_id, fk_tab_centro_custo_id FROM intranet.tab_despesa WHERE id_despesa = ?;";
        return DB::select($query, [$id]);
    }

    static function findByDueDate($date)
    {
        return DB::table('intranet.tab_despesa')
            ->where('fk_status_despesa_id', '=', StatusDespesa::A_PAGAR)->where('dt_vencimento', '<', $date)->get();
    }

    static function setStatusIfDefeaded($id)
    {
        DB::table('intranet.tab_despesa')
            ->where('id_despesa', '=', $id)
            ->update(['fk_status_despesa_id' => StatusDespesa::EM_ATRASO]);
    }

    static function setStatusIfPaid($id)
    {
        DB::table('intranet.tab_despesa')
            ->where('id_despesa', '=', $id)
            ->update(['fk_status_despesa_id' => StatusDespesa::PAGO]);
    }

    static function setProvisionDate($id, $date)
    {
        DB::table('intranet.tab_despesa')
            ->where('id_despesa', '=', $id)
            ->update(['dt_provisionamento' => $date]);
    }
}
