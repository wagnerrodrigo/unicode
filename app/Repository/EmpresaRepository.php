<?php

namespace App\Repository;

use App\Models\Empresa;
use Carbon\Carbon;


class EmpresaRepository
{
    function getEmpresas(){
        $empresas = Empresa::selectAll();
        return $empresas;
    }
}
