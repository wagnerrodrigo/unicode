<?php

namespace App\Repository;

use App\Models\ParcelaDespesa;


class ParcelaDespesaRepository {

    function store(array $parcelas){
        $parcelaDespesa = new ParcelaDespesa();
        for ($i = 0; $i < count($parcelas); $i++) {
            $parcelaDespesa->fk_despesa = $parcelas[$i]['fk_despesa'];
            $parcelaDespesa->num_parcela = $parcelas[$i]['num_parcela'];
            $parcelaDespesa->valor_parcela = $parcelas[$i]['valor_parcela'];
            $parcelaDespesa->dt_emissao = $parcelas[$i]['dt_emissao'];
            $parcelaDespesa->dt_vencimento = $parcelas[$i]['dt_vencimento'];
            $parcelaDespesa->dt_provisionamento = $parcelas[$i]['dt_provisionamento'];
            $parcelaDespesa->fk_status_id = $parcelas[$i]['fk_status_parcela_id'];
            $parcelaDespesa->dt_inicio = $parcelas[$i]['dt_inicio'];
            $parcelaDespesa->dt_fim = $parcelas[$i]['dt_fim'];

            ParcelaDespesa::store($parcelaDespesa);
        }
    }

    function getParcelasByDespesa($fk_despesa){
        return ParcelaDespesa::parcelasDespesa($fk_despesa);
    }

    function getParcela($idParcela){
        return ParcelaDespesa::parcela($idParcela);
    }

    function setStatusIfDefeaded($data)
    {
        $despesasVencidas = ParcelaDespesa::findByDueDate($data);

        for ($i = 0; $i < count($despesasVencidas); $i++) {
            ParcelaDespesa::setStatusIfDefeaded($despesasVencidas[$i]->id_parcela_despesa);
        }
    }

    function setStatusIfPaid($id_parcela_despesa){
        ParcelaDespesa::setStatusIfPaid($id_parcela_despesa);
    }

    function getExpenseById($id_parcela_despesa)
    {
        return ParcelaDespesa::parcela($id_parcela_despesa);
    }

    function setEndDate($id_parcela, $end_date)
    {
        return ParcelaDespesa::del($id_parcela, $end_date);
    }

    function addPayment(array $parcelas, $idParcela)
    {
        $parcela = new ParcelaDespesa();
        //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
        for ($i = 0; $i < count($parcelas); $i++) {
            $parcela->fk_condicao_pagamento = $parcelas['fk_condicao_pagamento'];
            $parcela->fk_tab_conta_bancaria = $parcelas['fk_tab_conta_bancaria'];
            $parcela->fk_pix_id = $parcelas['fk_tab_pix'];
            $parcela->dt_provisionamento = $parcelas['dt_provisionamento'];

            ParcelaDespesa::addPayment($parcela, $idParcela);
        }
    }

    function setStatus($id_parcela_despesa){
        ParcelaDespesa::setStatus($id_parcela_despesa);
    }
}
