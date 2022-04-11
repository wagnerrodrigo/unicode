<?php

namespace App\Repository;

use App\Models\Rateio;
use Carbon\Carbon;

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

    function findRateioDespesa($id)
    {
        return Rateio::getRateioDespesa($id);
    }

    function create(array $rateios, string $idDespesa)
    {
        $rateio = new Rateio();
        //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
        for ($i = 0; $i < count($rateios); $i++) {
            $rateio->fk_tab_centro_custo_id = $rateios[$i]['centro_custo_rateio'];
            $rateio->valor_rateio_despesa = $rateios[$i]['valor_rateio'];
            $rateio->porcentagem_rateio_despesa = $rateios[$i]['porcentagem_rateio'];
            $rateio->dt_inicio =  Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $rateio->dt_fim = null;
            $rateio->fk_tab_despesa = $idDespesa;

            Rateio::create($rateio);
        }
    }
}
