<?php

namespace App\Repository;

use App\Models\Rateio;


class RateioRepository
{
    function findContaBancariaRateioByLancamento($id_lancamento)
    {
        return Rateio::getContaBancariaRateioByLancamento($id_lancamento);
    }

    function setEndDateRateio($id_despesa, $end_date)
    {
        return Rateio::del($id_despesa, $end_date);
    }

    function findByLancamento($id)
    {
        return Rateio::getRateioLancamento($id);
    }
}
