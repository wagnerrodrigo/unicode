<?php

namespace App\Repository;

use App\Models\Despesa;
use App\Models\ItemDespesa;

class DespesaRepository
{

    function findPaymentCondition($id)
    {
        return Despesa::findPaymentConditionById($id);
    }

    //método busca condicao de pagamento, tipo de despesa e id do centro de custo
    function findTipoECentroCustoDespesa($id)
    {
        return Despesa::findTipoECentroCustoDespesa($id);
    }

    function getExpenseById($id, $tipo_despesa = null, $centro_custo = null)
    {
        return Despesa::findOne($id, $tipo_despesa, $centro_custo);
    }

    function getItems($id)
    {
        return ItemDespesa::getAllExpenseItems($id);
    }

    function setItemEndDate($id, $data)
    {
        ItemDespesa::setItemEndDate($id, $data);
    }

    function deleteExpense($id, $endDate){
        Despesa::del($id, $endDate);
    }
}
