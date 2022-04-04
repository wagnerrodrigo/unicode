<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemDespesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_tab_despesa_id',
        'fk_tab_produto_id',
        'de_item_despesa',
        'valor_unitario_item_despesa',
        'quantidade',
        'dt_inicio',
        'dt_fim',
        'valor_total_item_despesa'
    ];

    static function create($itemDespesa)
    {
        DB::insert("INSERT INTO intranet.tab_item_despesa
        (
        fk_tab_despesa_id,
        fk_tab_produto_id,
        de_item_despesa,
        valor_unitario_item_despesa,
        quantidade,
        dt_inicio,
        dt_fim,
        valor_total_item_despesa
        )
        VALUES(?, ?, ?, ?, ?, ?, ?, ?);
        ", [
            $itemDespesa->fk_tab_despesa_id,
            $itemDespesa->fk_tab_produto_id,
            $itemDespesa->de_item_despesa,
            $itemDespesa->valor_unitario_item_despesa,
            $itemDespesa->quantidade,
            $itemDespesa->dt_inicio,
            $itemDespesa->dt_fim,
            $itemDespesa->valor_total_item_despesa
        ]);
    }

    static function getAllExpenseItems($id)
    {
        return DB::select("SELECT * FROM intranet.tab_item_despesa
        WHERE fk_tab_despesa_id = " . $id);
    }

    static function setItemEndDate($id, $data)
    {
        DB::update("UPDATE intranet.tab_item_despesa
        SET dt_fim = '" . $data . "'
        WHERE id_item_despesa = " . $id);
    }
}
