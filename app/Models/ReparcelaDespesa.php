<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ReparcelaDespesa extends Model
{
    use HasFactory;

    protected $fillable = [
        "fk_despesa",
        "num_reparcela",
        "valor_reparcela",
        "dt_emissao",
        "dt_vencimento",
        "dt_provisionamento",
        "fk_status_id",
        "fk_condicao_pagamento",
        "fk_conta_bancaria",
        "fk_pix_id",
        "dt_inicio",
        "dt_fim"
    ];


    static function reparcelar($reparcelaDespesa)
    {
    
         DB::insert("INSERT INTO intranet.tab_reparcela_despesa
        (fk_despesa, 
        num_reparcela, 
        valor_reparcela,
        dt_emissao,
        dt_vencimento, 
        dt_provisionamento, 
        fk_status_id, 
        fk_condicao_pagamento,
        fk_conta_bancaria, 
        fk_pix_id, 
        dt_inicio, 
        dt_fim)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $reparcelaDespesa->fk_despesa,
            $reparcelaDespesa->num_reparcela,
            $reparcelaDespesa->valor_reparcela,
            $reparcelaDespesa->dt_emissao,
            $reparcelaDespesa->dt_vencimento,
            $reparcelaDespesa->dt_provisionamento,
            $reparcelaDespesa->fk_status_id,
            $reparcelaDespesa->fk_condicao_pagamento,
            $reparcelaDespesa->fk_conta_bancaria,
            $reparcelaDespesa->fk_pix_id,
            $reparcelaDespesa->dt_inicio,
            $reparcelaDespesa->dt_fim

        ]);   
    }


}

