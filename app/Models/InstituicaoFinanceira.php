<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstituicaoFinanceira extends Model
{
    use HasFactory;

    protected $fillable = [
        'co_banco',
        'de_banco',
        'dt_inicio',
        'dt_fim',
    ];

    static function selectAll()
    {
        $query = "SELECT id, co_banco, de_banco, dt_fim, dt_inicio
        FROM intranet.tab_inst_banco";
        
        $instBancarias = DB::select($query);

        return $instBancarias;
    }
}
