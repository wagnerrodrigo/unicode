<?php

namespace App\Repository;
use App\Models\Lancamento;


class LancamentoRepository
{

    function findAccountingEntryById($id)
    {
        return Lancamento::findOne($id);
    }

    function findAccountingEntryByIdReparcela($id)
    {
        return Lancamento::findOneReparcela($id);
    }

    function findAccountingEntryByStatus($status, $dt_lancamento, $dt_vencimento, $n_conta)
    {
        return Lancamento::findByStatus($status, $dt_lancamento, $dt_vencimento, $n_conta);
    }

    function findAccountingEntryByStatusReparcela($status, $dt_lancamento, $dt_vencimento, $n_conta)
    {
        return Lancamento::findByStatusReparcela($status, $dt_lancamento, $dt_vencimento, $n_conta);
    }

    function findAccountingEntryByPeriod($dt_lancamento, $dt_vencimento)
    {
        return Lancamento::findByPeriod($dt_lancamento, $dt_vencimento);
    }
}
