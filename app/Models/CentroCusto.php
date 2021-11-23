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
        $centroCustos = DB::select("SELECT id_centro_custo, fk_empresa_id, fk_tab_departamento, fk_tab_carteira_id, dt_inicio, dt_fim
        FROM intranet.tab_centro_custo        
        WHERE fk_empresa_id = ?", [$id]);

        return $centroCustos;
    }

    static function findByName($nome)
    {
        $centroCustos = DB::select("SELECT id_empresa, cnpj_empresa, de_empresa, regiao_empresa, dt_inicio, dt_fim
        FROM intranet.tab_empresa where de_empresa LIKE '%" . $nome . "%'");

        return $centroCustos;
    }
}
