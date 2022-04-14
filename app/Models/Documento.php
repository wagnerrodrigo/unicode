<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documento extends Model
{
    use HasFactory;

    static function store($documento)
    {
        DB::insert("INSERT INTO intranet.tab_documento
        (
            fk_tab_despesa_id,
            fk_tipo_documento_id,
            de_documento,
            dt_inicio
        )VALUES(?, ?, ?, ?)", [
            $documento->fk_tab_despesa_id,
            $documento->fk_tipo_documento_id,
            $documento->de_documento,
            $documento->dt_inicio,
        ]);
    }

    static function del($expenseId, $endDate)
    {
        DB::update("UPDATE intranet.tab_documento
        SET dt_fim = ?
        WHERE fk_tab_despesa_id = ?", [$endDate, $expenseId]);
    }
}
