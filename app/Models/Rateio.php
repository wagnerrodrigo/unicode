<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rateio extends Model
{
    use HasFactory;

    protected $fillable = [
        "valor_rateio_despesa",
        "porcentagem_rateio_despesa",
        "fk_tab_centro_custo_id",
        "fk_tab_item_despesa",
        "dt_inicio",
        "dt_fim",
    ];

    static function create($rateio)
    {
        DB::insert("INSERT INTO intranet.tab_rateio_despesa
        (valor_rateio_despesa, porcentagem_rateio_despesa, fk_tab_centro_custo_id, fk_tab_item_despesa, dt_inicio, dt_fim)
        VALUES(?, ?, ?, ?, ?, ?);
        ", [
            $rateio->valor_rateio_despesa,
            $rateio->porcentagem_rateio_despesa,
            $rateio->fk_tab_centro_custo_id,
            $rateio->fk_tab_item_despesa,
            $rateio->dt_inicio,
            $rateio->dt_fim
        ]);
    }

    static function createRateioLancamento($rateio){
        DB::insert("INSERT INTO intranet.tab_rateio_pagamento
        (valor_rateio_pagamento, fk_tab_conta_bancaria, dt_inicio, dt_fim)
        VALUES(?, ?, ?, ?)
        ",[
            $rateio->valor_rateio_pagamento,
            $rateio->fk_tab_conta_bancaria,
            $rateio->dt_inicio,
            $rateio->dt_fim
        ]);
    }
}
