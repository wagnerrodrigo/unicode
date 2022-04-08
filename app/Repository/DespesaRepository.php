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
    function findInfosDespesa($id)
    {
        return Despesa::findInfosDespesaById($id);
    }

    function setStatusIfDefeaded($data)
    {
        $despesasVencidas = Despesa::findByDueDate($data);

        for ($i = 0; $i < count($despesasVencidas); $i++) {
            Despesa::setStatusIfDefeaded($despesasVencidas[$i]->id_despesa);
        }
    }

    function setStatusIfPaid($id_despesa){
        Despesa::setStatusIfPaid($id_despesa);
    }

    function getExpenseById($id, $condicao_pagamento, $tipo_despesa)
    {
        return Despesa::findOne($id, $condicao_pagamento, $tipo_despesa);
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
