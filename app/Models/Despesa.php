<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    static function selectAll($results, $status = null, $chave_busca = null, $valor_busca = null)
    {
        $query = DB::table('intranet.tab_despesa')
            ->join(
                'intranet.status_despesa',
                'intranet.status_despesa.id_status_despesa',
                '=',
                'intranet.tab_despesa.fk_status_despesa_id'
            )->where('intranet.tab_despesa.dt_fim', '=', null);

        if ($chave_busca && $valor_busca && $status) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->where("intranet.tab_despesa.$chave_busca", '=', "$valor_busca")
                ->orderBy('de_status_despesa', 'asc')->paginate($results);
        } else if ($chave_busca && $valor_busca && !$status) {
            $despesas = $query
                ->where("intranet.tab_despesa.$chave_busca", '=', "$valor_busca")
                ->orderBy('de_status_despesa', 'asc')
                ->paginate($results);
        } else if (!$chave_busca && !$valor_busca && $status) {
            $despesas = $query
                ->where("intranet.tab_despesa.fk_status_despesa_id", '=', "$status")
                ->orderBy('de_status_despesa', 'asc')
                ->paginate($results);
        } else if (!$chave_busca && !$valor_busca && !$status) {

            $despesas = $query
                ->orderBy('de_status_despesa', 'asc')
                ->paginate($results);
        }
        return $despesas;
    }

    static function create($despesa)
    {
        DB::insert("INSERT INTO intranet.tab_despesa
        (fk_tab_centro_custo_id,
        fk_tab_tipo_despesa_id,
        fk_plano_contas,
        numero_documento_despesa,
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
        fk_conta_bancaria,
        tipo_documento)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
        ", [

            $despesa->fk_centro_de_custo,
            $despesa->fk_tipo_despesa,
            $despesa->fk_plano_contas,
            $despesa->numero_documento_despesa,
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
            $despesa->tipo_documento,
        ]);

        //values(cnpj,razao_social,inscricao_estadual,dt_inicio,dt_fim,nome_fantasia)
    }

    //retorna apenas o id para despesa
    static function findByTimeStamp($timestamp)
    {
        return DB::select("SELECT id_despesa FROM intranet.tab_despesa WHERE dt_inicio = ?", [$timestamp]);
    }

    static function findOne($id)
    {
        $query = DB::select("SELECT * FROM intranet.tab_despesa AS despesa
        JOIN intranet.status_despesa AS status_despesa ON status_despesa.id_status_despesa = despesa.fk_status_despesa_id
        JOIN intranet.tab_fornecedor AS fornecedor ON fornecedor.id_fornecedor = despesa.fk_tab_fornecedor_id
        LEFT JOIN intranet.tab_empregado AS empregado on empregado.id_empregado =  despesa.fk_tab_empregado_id
        JOIN intranet.tab_centro_custo AS centro_custo ON centro_custo.id_centro_custo = despesa.fk_tab_centro_custo_id
        JOIN intranet.tab_departamento AS departamento ON departamento.id_departamento = centro_custo.fk_tab_departamento
        JOIN intranet.tab_tipo_despesa AS tipo_despesa ON tipo_despesa.id_tipo_despesa = despesa.fk_tab_tipo_despesa_id
        WHERE despesa.dt_fim is null AND id_despesa = ? ;", [$id]);

        return $query;
    }

    static function set($despesa)
    {
        DB::update("UPDATE intranet.tab_despesa
        SET fk_tab_centro_custo_id = ?, fk_tab_empresa_id = ?, fk_tab_tipo_despesa_id = ?,
            numero_despesa = ?, qt_parcelas_despesa = ?, serie_despesa = ?,
            dt_emissao = ?, valor_total_despesa = ?, fk_status_despesa_id = ?,
            fk_tab_fornecedor_id = ?, fk_tab_empregado_id = ? , dt_inicio = ?
        WHERE id_despesa = ?", [
            $despesa->fk_tab_centro_custo_id,
            $despesa->fk_tab_empresa_id,
            $despesa->fk_tab_tipo_despesa_id,
            $despesa->numero_despesa,
            $despesa->qt_parcelas_despesa,
            $despesa->serie_despesa,
            $despesa->dt_emissao,
            $despesa->valor_total_despesa,
            $despesa->fk_status_despesa_id,
            $despesa->fk_tab_fornecedor_id,
            $despesa->fk_tab_empregado_id,
            $despesa->dt_inicio,
            $despesa->id_despesa
        ]);
    }

    static function del($dataFim, $id)
    {
        DB::update("UPDATE intranet.tab_fornecedor
        SET dt_fim = ?
        WHERE id_fornecedor = ?", [$dataFim, $id]);
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
}
