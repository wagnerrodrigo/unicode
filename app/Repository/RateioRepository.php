<?php

namespace App\Repository;

use App\Models\Rateio;


class RateioRepository
{

    function findRateioLancamento($id_lancamento)
    {
        return Rateio::getRateioLancamento($id_lancamento);
    }
}
