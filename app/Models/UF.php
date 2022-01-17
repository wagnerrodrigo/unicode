<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UF extends Model
{
    use HasFactory;

    static function findIdByUF($uf){
        $estado = DB::select("SELECT id_uf FROM intranet.tab_uf WHERE sg_uf = ?", [$uf]);

        return $estado[0]->id_uf;
    }
}
