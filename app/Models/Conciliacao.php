<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conciliacao extends Model
{
    use HasFactory;

    static function store($conciliacao)
    {
        return DB::insert("INSERT INTO intranet.tab_conciliacao
        (fk_lancamento_id,fk_extrato_id,dt_inicio)
        VALUES(?, ?, ?);
        ", [
            $conciliacao->id_lancamento,
            $conciliacao->id_extrato,
            $conciliacao->dt_inicio,
        ]);
    }
}
