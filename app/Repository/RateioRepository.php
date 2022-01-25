<?php

namespace App\Repository;

use App\Models\Rateio;


class RateioRepository
{
    function findContaBancariaRateioByLancamento($id_lancamento)
    {
        return Rateio::getContaBancariaRateioByLancamento($id_lancamento);
    }
}
