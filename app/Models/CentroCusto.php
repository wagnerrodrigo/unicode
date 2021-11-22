<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CentroCusto extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa',
        'nome',
        'responsavel',
        'data_fim',
    ];


    static function findById($id)
    {
        $centroCustos = DB::select("SELECT id_empresa_centro_custo,
        fk_empresa_id,
        fk_tab_centro_custo_id,
        id_empresa,cnpj_empresa,
        de_empresa,
        regiao_empresa,
        id_centro_custo,
        de_centro_custo,
        co_centro_custo
        FROM intranet.tab_empresa_centro_custo AS empresa_centro_custo
        JOIN intranet.tab_empresa AS empresa ON empresa_centro_custo.fk_empresa_id = empresa.id_empresa
        JOIN intranet.tab_centro_custo AS centro_custo ON empresa_centro_custo.fk_tab_centro_custo_id = centro_custo.id_centro_custo
        WHERE fk_empresa_id = ?", [$id]);

        return $centroCustos;
    }

    static function findByName($nome)
    {
        $centroCustos = DB::select("SELECT
        DISTINCT a.fk_empresa_id,
        a.id_empresa_centro_custo,
        a.fk_tab_centro_custo_id,
        b.id_empresa,
        b.cnpj_empresa,
        b.de_empresa,
        b.regiao_empresa,
        c.id_centro_custo,
        c.de_centro_custo,
        a.co_centro_custo
        FROM intranet.tab_empresa_centro_custo a
        inner JOIN intranet.tab_empresa b ON (a.fk_empresa_id = b.id_empresa)
        inner JOIN intranet.tab_centro_custo c ON (a.fk_tab_centro_custo_id = c.id_centro_custo)
        where b.de_empresa LIKE '%" . $nome . "%'");

        return $centroCustos;
    }
}
