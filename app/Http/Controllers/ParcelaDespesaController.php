<?php

namespace App\Http\Controllers;

use App\Repository\ParcelaDespesaRepository;
use Illuminate\Http\Request;

class ParcelaDespesaController extends Controller
{
    public function getDespesas($idDespesa){
        $parcelaDespesaRepository = new ParcelaDespesaRepository();
        $parcelas = $parcelaDespesaRepository->getParcelasByDespesa($idDespesa);

        return response()->json($parcelas);
    }
}
