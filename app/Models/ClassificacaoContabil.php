<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassificacaoContabil extends Model
{
    use HasFactory;


    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_clasificacao_contabil order by de_clasificacao_contabil asc;";
        $classificacaoContabil = DB::select($query);

        return $classificacaoContabil;
    }

    static function selectById($id)
    {
        $query = "SELECT
        id_plano_contas,
        fk_tab_clasificacao_contabil_id,
        fk_tab_de_plano_contas,
        de_plano_contas
        FROM intranet.tab_plano_contas
        inner join intranet.de_plano_contas on de_plano_contas.id_de_plano_contas = tab_plano_contas.fk_tab_de_plano_contas
        where fk_tab_clasificacao_contabil_id = ?";
        $classificacaoContabil = DB::select($query, [$id]);

        return $classificacaoContabil;
    }
}
