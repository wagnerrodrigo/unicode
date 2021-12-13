<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pix extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_pix',
        'de_pix',
        'fk_tab_tipo_pix_id',
        'fk_tab_empregado_id',
        'fk_tab_empresa_id',
        'fk_tab_fornecedor_id'
    ];

    static function getPixFornecedor($id)
    {
        return DB::select("SELECT
        pix.id_pix,
        pix.de_pix,
        pix.fk_tab_tipo_pix_id,
        pix.fk_tab_fornecedor_id,
        tipo_pix.de_tipo_pix
        FROM intranet.tab_pix as pix
        inner join intranet.tab_tipo_pix as tipo_pix on pix.fk_tab_tipo_pix_id = tipo_pix.id_tipo_pix
        WHERE pix.fk_tab_fornecedor_id = $id");
    }
}
