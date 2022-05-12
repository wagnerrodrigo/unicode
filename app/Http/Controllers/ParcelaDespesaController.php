<?php

namespace App\Http\Controllers;

use App\Models\ParcelaDespesa;
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
        foreach($despesaRepository->findTipoECentroCustoDespesa($parcela->fk_despesa) as $tipoDespesa){}
        foreach($despesaRepository->getExpenseById($parcela->fk_despesa, $tipoDespesa->fk_tab_tipo_despesa_id, $tipoDespesa->fk_tab_centro_custo_id) as $despesa){}

        return view('admin.despesas.detalhe-parcela', compact('parcela', 'despesa', 'tipo', 'rateios', 'mascara'));
    }

    public function setParcelaDespesa(Request $request){
        dd($request->all());
    }

    public function setProvisionDate(Request $request)
    {
        try {
            $provisionDate = $request->date;
            $ExpenseIds = $request->ids;

            foreach ($ExpenseIds as $id) {
                ParcelaDespesa::setProvisionDate($id, $provisionDate);
            }

            return redirect()->back()->with('success', 'Data de provisionamento alterada!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Não foi possível editar a Data de provisionamento' . $e->getMessage());
        }
    }
}
