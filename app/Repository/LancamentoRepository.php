<?php

namespace App\Repository;

use App\Models\Lancamento;


class LancamentoRepository
{

    function findAccountingEntryById($id)
    {
        return Lancamento::findOne($id);
    }
}
