<?php

namespace App\Repository;

use App\Models\Despesa;


class DespesaRepository
{

    function findPaymentCondition($id)
    {
        return Despesa::findPaymentConditionById($id);
    }

    //métodos busca condicao de pagamento e tipo de despesa
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
}
