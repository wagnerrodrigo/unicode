<?php

namespace App\Http\Controllers;

use App\Models\UF;
use App\Models\Cidade;
use Illuminate\Http\Request;


class TesteController extends Controller
{


    public function all()
    {

        $uf = new UF();
        $cidade = new Cidade();

        $uf::findIdByUF('MG');
        $cidade::findIdByCidade('BELO HORIZONTE');

        dd($uf, $cidade);
    }
}
