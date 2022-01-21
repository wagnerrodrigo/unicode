<?php

namespace App\Repository;

use App\Models\Despesa;


class DespesaRepository
{

    function findPaymentCondition($id)
    {
        return Despesa::findPaymentConditionById($id);
    }


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
}
