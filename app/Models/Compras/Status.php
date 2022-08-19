<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    protected $fillable = [
        'id_compra',
        'fk_id_status',
        'status_atual'
    ];


    public function salvarCotacao(Status $status)
    {
        dd($status)->all();

        DB::insert("insert into intranet.status
        (id_compra
        fk_id_pedido,
        status_atual)
        values (?, ?, ?)", [
            $status->fk_id_status,
            $status->status_atual
        ]);
    }

    /*
    public function pedidos()
    {
        $pedidos = DB::select("SELECT * FROM intranet.tab_cotacao
        WHERE id_ = ?;");

        $pedidoss = $pedidos[0];
        return $pedidoss;
    }*/
}
