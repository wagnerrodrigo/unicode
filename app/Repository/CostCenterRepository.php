<?php

namespace App\Repository;

use App\Models\CentroCusto;


class CostCenterRepository
{

    function getCenterCostByIdCompany($id_company)
    {
        $costCenter = CentroCusto::findById($id_company);
        return $costCenter;
    }
}
