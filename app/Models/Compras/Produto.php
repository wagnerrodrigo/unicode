<?php

namespace App\Models\Compras;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $fillable = [
        'fk_tab_solicitacao_compra_id',
        'fk_tab_produto_id',
        'fk_tab_tipo_produto_id',
        'quantidade',
        'complemento_produto'
    ];

    
    static function salvarProduto($purchase)
    {
    DB::insert("INSERT INTO intranet.tab_produto_solicitado
        (
        fk_tab_solicitacao_compra_id,
        fk_tab_produto_id,
        fk_tab_tipo_produto_id,
        quantidade,
        complemento_produto)
        VALUES (?, ?, ?, ?, ?)
        ", [
            $purchase->fk_tab_solicitacao_compra_id,
            $purchase->fk_tab_produto_id,
            $purchase->fk_tab_tipo_produto_id,
            $purchase->quantidade,
            $purchase->complemento_produto
           ]);
           echo "<script> alert('Pedido criado com sucesso!!') </script>";
    }

    static function findByTimeStamp($timestamp)
    {
        return DB::select("SELECT intranet.tab_produto_pedido FROM id_pedido WHERE data_pedido = ?", [$timestamp]);
    }

    // public function pedido(){
    //     return $this->belongsTo(Pedido::class, 'id_solicitacao_compra');
    // }

}
