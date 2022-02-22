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
        $centroCustos = DB::select("SELECT * FROM intranet.tab_centro_custo
        inner join intranet.tab_departamento on fk_tab_departamento = id_departamento
        inner join intranet.tab_carteira on fk_tab_carteira_id = id_carteira
        WHERE fk_empresa_id = ? order by de_departamento asc", [$id]);

        return $centroCustos;
    }

    static function findByName($nome)
    {
        $centroCustos = DB::select("SELECT id_empresa, cnpj_empresa, de_empresa, regiao_empresa, dt_inicio, dt_fim
        FROM intranet.tab_empresa where de_empresa LIKE '%" . $nome . "%'");

        return $centroCustos;
    }
}
