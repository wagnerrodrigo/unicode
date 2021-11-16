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
        return DB::select("SELECT
        id_despesa, 
        fk_tab_centro_custo_id, 
        fk_tab_empresa_id, 
        fk_tab_tipo_despesa_id, 
        numero_despesa, 
        qt_parcelas_despesa, 
        serie_despesa, 
        dt_emissao, 
        valor_total_despesa, 
        fk_status_despesa_id, 
        fk_tab_fornecedor_id, 
        fk_tab_empregado_id,    
        dt_inicio, 
        dt_fim
        FROM intranet.tab_despesa;");
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
        $data = DB::select("SELECT * FROM intranet.tab_fornecedor
        WHERE id_fornecedor = ?;", [$id]);

        $fornecedor = $data[0];
        return $fornecedor;
    }


    static function set($despesa){
        DB::update( "UPDATE intranet.tab_despesa
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
}
