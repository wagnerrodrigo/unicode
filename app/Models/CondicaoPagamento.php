<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CondicaoPagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'de_condicao_pagamento',
        'dt_inicio',
        'dt_fim'
    ];


    static function selectAll()
    {
        return DB::select("SELECT id_condicao_pagamento, 
        de_condicao_pagamento, 
        dt_inicio, 
        dt_fim FROM intranet.tab_condicao_pagamento");
    }
}
