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
        $query = "SELECT * FROM intranet.tab_clasificacao_contabil;";
        $classificacaoContabil = DB::select($query);

        return $classificacaoContabil;
    }
}
