@extends('layouts.templates.template')
@section('title', 'Nota Fiscal')
@include('../layouts/__partials/header')

@section('content')
<div class="container" >
    <main>
        <div class="d-flex p-2 bd-highlight">
            <h3>Nota Fiscal</h3>
        </div>

        <div class="d-flex p-2">
            <div class="border" style="width: 50%">
                <div class="d-flex bd-highlight ">
                    <strong>Nome Fornecedor</strong>
                </div>

                <div class="d-flex flex-column bd-highlight p-2">
                    <span class="col">Rua A, 134, SALA 72, Bairro Teste</span>
                    <span class="col">Fone (32) 3333-1717 www.siteempresa.com</span>
                    <span class="col">email@empresa.com.br</span>
                </div>
            </div>

            <div class="d-flex p-1 bd-highlight">
                <div class="card  mr-md-5 p-2">
                    <strong>NF-e</strong>
                    <span>N 00037039</span>
                    <span>Serie 1</span>
                </div>

                <div class="card p-2 mr-md-5 ">
                    <strong>Chave de Acesso</strong>
                    <span>1235 76152 7653 9873 6514 8763 6542 8763</span>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Natureza da Operação</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>Venda de Mercadorias</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong> Protocolo de autorização de uso</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>135211138053416 05/10/2021 09:00:57</span>
                </div>
            </div>
        </div>

        <h3>Destinatário/Remetente</h3>
        <div class="d-flex p-2">
            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Nome/Razão social</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>Pedroenrick Felizardo</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong> CPF/CNPJ</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>111.111.111-08</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>inscrição Estadual</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span></span>
                </div>
            </div>

            <div class="border mx-2" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Data Emissão</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>06/10/2021</span>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Endereço</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>Rua teste, 281 - Referência teste</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Bairro</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>Bairro Teste</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>CEP</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>36.010-000</span>
                </div>
            </div>

            <div class="border mx-2" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Data Saída</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>06/10/2021</span>
                </div>
            </div>
        </div>

        <div class="d-flex p-2">
            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Município</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>Juiz de Fora</span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Fone/Fax</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span></span>
                </div>
            </div>

            <div class="border" style="width: 50%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>UF</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>MG</span>
                </div>
            </div>

            <div class="border mx-2" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Hora Saída</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>10:22:55</span>
                </div>
            </div>
        </div>

        <h3>Faturas</h3>

        <div class="d-flex p-2">
            <div class="border" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Número</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>001</span>
                </div>
            </div>

            <div class="border" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Vencimento</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>29/10/2021</span>
                </div>
            </div>

            <div class="border" style="width: 25%">
                <div class="d-flex p-2 bd-highlight ">
                    <strong>Valor</strong>
                </div>

                <div class="d-flex p-2 bd-highlight">
                    <span>999,99</span>
                </div>
            </div>
        </div>

        <h3>Itens da nota fiscal</h3>

        <div class="pb-5 ml-2">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th class="p-2" scope="col">Código</th>
                        <th class="p-2" scope="col">Descrição</th>
                        <th class="p-2" scope="col">NCM/SH</th>
                        <th class="p-2" scope="col">CST</th>
                        <th class="p-2" scope="col">CFOP</th>
                        <th class="p-2" scope="col">UN</th>
                        <th class="p-2" scope="col">Qtde</th>
                        <th class="p-2" scope="col">Preço un</th>
                        <th class="p-2" scope="col">Preço total</th>
                        <th class="p-2" scope="col">BC ICMS</th>
                        <th class="p-2" scope="col">Vlr. ICMS</th>
                        <th class="p-2" scope="col">Vlr. IPI</th>
                        <th class="p-2" scope="col">%ICMS</th>
                        <th class="p-2" scope="col">%IPI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4">1</td>
                        <td class="p-4">Teste</td>
                        <td class="p-4">teste</td>
                        <td class="p-4">teste</td>
                        <td class="p-4">teste</td>
                        <td class="p-4">1</td>
                        <td class="p-4">1</td>
                        <td class="p-4">999,99</td>
                        <td class="p-4">999,99</td>
                        <td class="p-4">0,00</td>
                        <td class="p-4">0,00</td>
                        <td class="p-4">0,00</td>
                        <td class="p-4">12,0000</td>
                        <td class="p-4">0,00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection