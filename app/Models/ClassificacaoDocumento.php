<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClassificacaoDocumento extends Model
{
    use HasFactory;

    static function selectAll(){
        return DB::select("SELECT * FROM intranet.tab_tipo_documento ORDER BY de_tipo_documento ASC;");
    }

    static function findByDocuments(){
        return DB::select("SELECT * FROM intranet.tab_tipo_documento;");
    }
}

