<?php

namespace App\Http\Controllers;

use App\Repository\DespesaRepository;
use App\Repository\ParcelaDespesaRepository;
use App\Repository\RateioRepository;
use App\Utils\Mascaras\Mascaras;
use App\Utils\TipoDespesa;
use Illuminate\Http\Request;

class ParcelaDespesaController extends Controller
{
    public function getDespesas($idDespesa)
    {
        $parcelaDespesaRepository = new ParcelaDespesaRepository();
        $parcelas = $parcelaDespesaRepository->getParcelasByDespesa($idDespesa);

        return response()->json($parcelas);
    }

    public function getParcela($idParcela)
    {
        $despesaRepository = new DespesaRepository();
        $parcelaDespesaRepository = new ParcelaDespesaRepository();
        $rateioRepository = new RateioRepository();
        $parcela = $parcelaDespesaRepository->getParcela($idParcela);
        $rateios = $rateioRepository->findRateioDespesa($parcela->fk_despesa);
        $mascara = new Mascaras();

        $tipo = TipoDespesa::class;

        foreach($despesaRepository->getExpenseById($parcela->fk_despesa, TipoDespesa::EMPREGADO) as $despesa){}

        return view('admin.despesas.detalhe-parcela', compact('parcela', 'despesa', 'tipo', 'rateios', 'mascara'));
    }
}
