<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_tab_tipo_despesa_id',
        'fk_tab_empresa_id',
        'numero',
        'serie',
        'quantidade_parcelas',
        'valor_total',
        'dt_emissao',
        'fk_status_despesa_id',
        'fk_tab_condicao_pagamento_id',
        'fk_tab_fornecedor_id',
        'fk_tab_empregado_id',
        'dt_inicio',
        'dt_fim'
    ];
    //Ao passar parametros, se atentar a ordem que é passado na query
    static function selectAll()
    {
        return DB::select("SELECT * FROM intranet.tab_despesa AS despesa
        JOIN intranet.tab_status_despesa AS status_despesa ON status_despesa.id_staus_despesa = despesa.fk_status_despesa_id
        JOIN intranet.tab_fornecedor AS fornecedor ON fornecedor.id_fornecedor = despesa.fk_tab_fornecedor_id
        left JOIN intranet.tab_empregado AS empregado on empregado.id_empregado =  despesa.fk_tab_empregado_id
        JOIN intranet.tab_centro_custo AS centro_custo ON centro_custo.id_centro_custo = despesa.fk_tab_centro_custo_id
        JOIN intranet.tab_empresa AS empresa ON empresa.id_empresa = despesa.fk_tab_empresa_id
        JOIN intranet.tab_tipo_despesa AS tipo_despesa ON tipo_despesa.id_tipo_despesa =despesa.fk_tab_tipo_despesa_id
        left JOIN intranet.tab_plano_contas AS plano_contas ON despesa.fk_plano_contas_id = plano_contas.id_plano_contas");
    }

    static function create($fornecedor)
    {
        DB::insert("insert into intranet.tab_fornecedor
        (nu_cpf_cnpj,de_razao_social,inscricao_estadual,dt_inicio,dt_fim,de_nome_fantasia)
        values (?, ?, ?, ?, null, ? )", [
            $fornecedor->nu_cpf_cnpj,
            $fornecedor->de_razao_social,
            $fornecedor->inscricao_estadual,
            $fornecedor->dt_inicio,
            $fornecedor->de_nome_fantasia,
        ]);
        //values(cnpj,razao_social,inscricao_estadual,dt_inicio,dt_fim,nome_fantasia)
    }

    static function findOne($id)
    {
        $despesa = DB::select("SELECT * FROM intranet.tab_despesa AS despesa
        JOIN intranet.tab_status_despesa AS status_despesa ON status_despesa.id_staus_despesa = despesa.fk_status_despesa_id
        JOIN intranet.tab_fornecedor AS fornecedor ON fornecedor.id_fornecedor = despesa.fk_tab_fornecedor_id
        left JOIN intranet.tab_empregado AS empregado on empregado.id_empregado =  despesa.fk_tab_empregado_id
        JOIN intranet.tab_centro_custo AS centro_custo ON centro_custo.id_centro_custo = despesa.fk_tab_centro_custo_id
        JOIN intranet.tab_empresa AS empresa ON empresa.id_empresa = despesa.fk_tab_empresa_id
        JOIN intranet.tab_tipo_despesa AS tipo_despesa ON tipo_despesa.id_tipo_despesa = despesa.fk_tab_tipo_despesa_id
        WHERE id_despesa = ?;", [$id]);

        return $despesa;
    }

    static function set($fornecedor)
    {
        DB::update("UPDATE intranet.tab_fornecedor
        SET de_razao_social = ?, inscricao_estadual = ?, dt_inicio = ?, de_nome_fantasia = ?
        WHERE id_fornecedor = ?", [
            $fornecedor->de_razao_social,
            $fornecedor->inscricao_estadual,
            $fornecedor->dt_inicio,
            $fornecedor->de_nome_fantasia,
            $fornecedor->id_fornecedor
        ]);
    }

    static function del($dataFim, $id)
    {
        DB::update("UPDATE intranet.tab_fornecedor
        SET dt_fim = ?
        WHERE id_fornecedor = ?", [$dataFim, $id]);
    }
}
