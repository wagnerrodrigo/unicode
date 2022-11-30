<?php

namespace App\Repository;

use App\Models\ParcelaDespesa;
use App\Models\ReparcelaDespesa;

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

    function reparcelar($parcela){
        $reparcelaDespesa = new ReparcelaDespesa();
        for ($i = 0; $i < count($parcela); $i++) {
            $reparcelaDespesa->fk_despesa = $parcela[$i]['fk_despesa'];
            $reparcelaDespesa->num_reparcela = $parcela[$i]['num_parcela'];

            $reparcelaDespesa->valor_reparcela = trim(html_entity_decode($parcela[$i]['valor_parcela']), " \t\n\r\0\x0B\xC2\xA0");
            $reparcelaDespesa->valor_reparcela = str_replace(".", "", $reparcelaDespesa->valor_reparcela);
            $reparcelaDespesa->valor_reparcela = str_replace(",", ".", $reparcelaDespesa->valor_reparcela);
           
            $reparcelaDespesa->dt_emissao = $parcela[$i]['dt_emissao'];
            $reparcelaDespesa->dt_vencimento = $parcela[$i]['dt_vencimento'];
            $reparcelaDespesa->dt_provisionamento = $parcela[$i]['dt_provisionamento'];
            $reparcelaDespesa->fk_status_id = $parcela[$i]['fk_status_id'];
            $reparcelaDespesa->fk_condicao_pagamento = $parcela[$i]['fk_condicao_pagamento'];
            $reparcelaDespesa->fk_conta_bancaria = $parcela[$i]['fk_conta_bancaria'];
            $reparcelaDespesa->fk_pix_id = $parcela[$i]['fk_pix_id'];
            $reparcelaDespesa->dt_inicio = $parcela[$i]['dt_inicio'];
            $reparcelaDespesa->dt_fim = $parcela[$i]['dt_fim'];

            ReparcelaDespesa::reparcelar($reparcelaDespesa);
        }
    }
    
    function getParcelasByDespesa($fk_despesa){
        return ParcelaDespesa::parcelasDespesa($fk_despesa);
    }

    function getReparcelasByDespesa($fk_despesa){
        return ParcelaDespesa::reparcelasDespesa($fk_despesa);
    }

    function cancelarParcelasAntigas($id){
        return ParcelaDespesa::cancelarParcelasAntigas($id);
    }

    function AlterarStatusDespesaReparcela($id){
        return ParcelaDespesa::AlterarStatusDespesaReparcela($id);
    }

    function TotalParcelas($id){
        return ParcelaDespesa::TotalParcelas($id);
    }

    function getParcela($idParcela){
        return ParcelaDespesa::parcela($idParcela);
    }

    function getReparcela($idParcela){
        return ParcelaDespesa::reparcela($idParcela);
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

    function setStatusIfPaidreparcela($id_parcela_despesa){
        ParcelaDespesa::setStatusIfPaidreparcela($id_parcela_despesa);
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

    function addPaymentReparcela(array $parcelas, $idParcela)
    {
        $parcela = new ParcelaDespesa();
        //percorre o novo array e chama o metodo de inserção no banco para cada indice do array de rateios
        for ($i = 0; $i < count($parcelas); $i++) {
            $parcela->fk_condicao_pagamento = $parcelas['fk_condicao_pagamento'];
            $parcela->fk_tab_conta_bancaria = $parcelas['fk_tab_conta_bancaria'];
            $parcela->fk_pix_id = $parcelas['fk_tab_pix'];
            $parcela->dt_provisionamento = $parcelas['dt_provisionamento'];

            ParcelaDespesa::addPaymentReparcela($parcela, $idParcela);
        }
    }

    function setStatus($id_parcela_despesa){
        ParcelaDespesa::setStatus($id_parcela_despesa);
    }

    function setStatusReparcela($id_parcela_despesa){
        ParcelaDespesa::setStatusReparcela($id_parcela_despesa);
    }
}
