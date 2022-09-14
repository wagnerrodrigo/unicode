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
        'valor_produto',
        'unidade_medida'
    ];

    static function salvarProduto($purchase)
    {
    DB::insert("INSERT INTO intranet.tab_produto_solicitado
        (
        fk_tab_solicitacao_compra_id,
        fk_tab_produto_id,
        fk_tab_tipo_produto_id,
        quantidade,
        valor_produto,
        unidade_medida)
        VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $purchase->fk_tab_solicitacao_compra_id,
            $purchase->fk_tab_produto_id,
            $purchase->fk_tab_tipo_produto_id,
            $purchase->quantidade,
            $purchase->valor_produto,
            $purchase->unidade_medida
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


    static function ProdutoAll($id)
    {
        //ID  Solicitante	Titulo	Setor	Data	Status
        $query = DB::table('intranet.tab_produto_solicitado')
            ->select( 
                'tab_produto_solicitado.id_produto_solicitado',
                'tab_produto_solicitado.fk_tab_solicitacao_compra_id',
                'tab_produto_solicitado.quantidade',
                'tab_produto_solicitado.unidade_medida',
                'tab_produto.de_produto',
                'tab_tipo_produto.de_tipo_produto',
                'tab_solicitacao_compra.id_solicitacao_compra'
            )->join(
                'intranet.tab_produto',
                'intranet.tab_produto.id_produto',
                '=',
                'intranet.tab_produto_solicitado.fk_tab_produto_id'
            )->join(
                'intranet.tab_tipo_produto',
                'intranet.tab_tipo_produto.id_tipo_produto',
                '=',
                'intranet.tab_produto.fk_tab_tipo_produto_id'
            )->join(
                'intranet.tab_solicitacao_compra',
                'intranet.tab_solicitacao_compra.id_solicitacao_compra',
                '=',
                'intranet.tab_produto_solicitado.fk_tab_solicitacao_compra_id'
            );

            $produto = $query
                ->orderBy('fk_tab_solicitacao_compra_id', 'desc')
                ->paginate($id);

        return $produto;
    }

}
