<?php

namespace App\Repository;

use App\Models\Compras\Produto;
use Carbon\Carbon;


class ProdutoCompraRepository
{
    function create(array $items, string $produtoId)
    {
        $itemProduto = new Produto();
        //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
        for ($i = 0; $i < count($items); $i++) {
            $itemProduto->fk_tab_solicitacao_compra_id = $produtoId;
            $itemProduto->fk_tab_produto_id = $items[$i]['fk_tab_produto_id'];
            $itemProduto->fk_tab_tipo_produto_id = $items[$i]['fk_tab_tipo_produto_id'];
            $itemProduto->valor_produto = $items[$i]['valor_produto'];
            $itemProduto->quantidade = $items[$i]['quantidade'];
            $itemProduto->unidade_medida = $items[$i]['unidade_medida'];
            Produto::salvarProduto($itemProduto);
        }
    }
}
