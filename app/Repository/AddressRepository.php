<?php

namespace App\Repository;

use App\Models\Endereco;
use App\Models\UF;
use App\Models\Cidade;
use Carbon\Carbon;


class AddressRepository
{
    function createAddress($id_fornecedor, $enderecos)
    {
        //separa os enderecos em um array
        for ($i = 0; $i < count($enderecos); $i++) {
            $uf_id = UF::findIdByUF($enderecos[$i]['uf']);
            $cidade_id = Cidade::findIdByCidade($enderecos[$i]['localidade']);
            $cep = str_replace('-', '', $enderecos[$i]['cep']);
            $enderecos[$i] = [
                "cep" => $cep,
                "logradouro" => $enderecos[$i]['logradouro'],
                "numero" => $enderecos[$i]['numero'],
                "complemento" => $enderecos[$i]['complemento'],
                "bairro" => $enderecos[$i]['bairro'],
                "fk_tab_cidade_id" => $cidade_id,
                "fk_tab_uf_id" => $uf_id,
            ];
        }

        //dd($enderecos);
        //salva os enderecos
        $endereco = new Endereco();

        for ($i = 0; $i < count($enderecos); $i++) {
            $endereco->fk_tab_fornecedor_id = $id_fornecedor[0]->id_fornecedor;
            $endereco->cep = $enderecos[$i]['cep'];
            $endereco->fk_tipo_logradouro = 1;
            $endereco->fk_tipo_endereco_id = 2;
            $endereco->logradouro = $enderecos[$i]['logradouro'];
            $endereco->numero = $enderecos[$i]['numero'];
            $endereco->complemento = $enderecos[$i]['complemento'];
            $endereco->bairro = $enderecos[$i]['bairro'];
            $endereco->fk_tab_cidade_id = $enderecos[$i]['fk_tab_cidade_id'];
            $endereco->fk_tab_uf_id = $enderecos[$i]['fk_tab_uf_id'];
            $endereco->dt_inicio = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
            $endereco->dt_fim = null;

            Endereco::create($endereco);
        }
    }

    function findAddressByProvider($id_provider)
    {
        $adresses = Endereco::findByProvider($id_provider);
        return $adresses;

    }

    function deleteAddress($id_adress, $date){
        Endereco::setEndDate($id_adress, $date);
    }
}
