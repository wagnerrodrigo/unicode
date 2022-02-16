<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pagamento',
        'de_pagamento',
        'fk_tab_lancamento_id',
        'dt_inicio',
        'dt_fim',
        'fk_rateio_pagamento',
        'fk_tab_conciliacao'

    ];

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_despesa where fk_status_despesa_id = ? ";

        $pagamento = DB::select($query, [config('constants.PAGO')]);

        return $pagamento;
    }

    static function findOne()
    {
    }


    static function create($pagamento)
    {
        DB::insert("INSERT INTO intranet.tab_pagamento
        (
        fk_tab_lancamento_id,
        dt_inicio,
        dt_fim,
        fk_rateio_pagamento,
        fk_tab_conciliacao
        )
        VALUES(?, ?, ?, ?, ?)", [
            $pagamento->fk_tab_lancamento_id,
            $pagamento->dt_inicio,
            $pagamento->dt_fim,
            $pagamento->fk_rateio_pagamento,
            $pagamento->fk_tab_conciliacao
        ]);
    }
}
