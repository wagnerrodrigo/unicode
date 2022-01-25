<?php

namespace App\Repository;

use App\Models\Lancamento;


class LancamentoRepository
{

    function findAccountingEntryById($id)
    {
        return Lancamento::findOne($id);
    }

    function findAccountingEntryByStatus($status)
    {
        return Lancamento::findByStatus($status);
    }

    function findAccountingEntryByPeriod($dt_lancamento, $dt_vencimento)
    {
        return Lancamento::findByPeriod($dt_lancamento, $dt_vencimento);
    }
}
