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
}
