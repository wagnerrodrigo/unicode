<?php

namespace App\Repository;

use App\Models\Pagamento;


class PagamentoRepository
{

    function savePayment(Pagamento $pagamento)
    {
        Pagamento::create($pagamento);
    }
}
