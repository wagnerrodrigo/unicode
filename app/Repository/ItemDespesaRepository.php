<?php

namespace App\Repository;

use App\Models\ItemDespesa;
use Carbon\Carbon;


class ItemDespesaRepository
{
    function create(array $items, string $despesa_id)
    {
        $itemDespesa = new ItemDespesa();
        //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
        for ($i = 0; $i < count($items); $i++) {
            $itemDespesa->fk_tab_despesa_id = $despesa_id;
            $itemDespesa->fk_tab_produto_id = $items[$i]['fk_tab_produto_id'];
            $itemDespesa->valor_unitario_item_despesa = $items[$i]['valor_unitario_item_despesa'];
            $itemDespesa->quantidade = $items[$i]['quantidade'];
            $itemDespesa->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $itemDespesa->dt_fim = null;
            $itemDespesa->valor_total_item_despesa = $items[$i]['valor_unitario_item_despesa'] * $items[$i]['quantidade'];
            ItemDespesa::create($itemDespesa);
        }
    }
}
