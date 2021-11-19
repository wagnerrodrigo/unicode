<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_despesa',
        'fk_tab_centro_custo_id',
        'fk_tab_empresa_id',
        'fk_tab_tipo_despesa_id',
        'numero_despesa',
        'qt_parcelas_despesa',
        'serie_despesa',
        'dt_emissao',
        'valor_total_despesa',
        'fk_status_despesa_id',
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

    static function create($despesa)
    {
        DB::insert("insert into intranet.tab_despesa
        (fk_tab_centro_custo_id = ?, fk_tab_empresa_id = ?, fk_tab_tipo_despesa_id = ?, 
            numero_despesa = ?, qt_parcelas_despesa = ?, serie_despesa = ?, 
            dt_emissao = ?, valor_total_despesa = ?, fk_status_despesa_id = ?,
            fk_tab_fornecedor_id = ?, fk_tab_empregado_id = ?, dt_inicio = ?)
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, null )", [

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
            $despesa->dt_inicio
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
}