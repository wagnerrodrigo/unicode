@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Nova Despesa</h1>
                <div class="list-group list-group-horizontal-sm mb-1 text-center d-flex justify-content-center" role="tablist">
                    <a class="list-group-item list-group-item-action active select-tab" id="list-despesa-list" data-bs-toggle="list" href="#list-despesa" role="tab">Despesa com Fornecedor</a>
                    <a class="list-group-item list-group-item-action select-tab" id="list-despesa-pessoal-list" data-bs-toggle="list" href="#list-despesa-pessoal" role="tab">Despesa com Pessoal</a>
                </div>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center tab-pane fade show active " id="list-despesa" role="tabpanel" aria-labelledby="list-despesa-list">
                        <form action="/despesas/adicionar" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Coligada</strong>
                                    <select class="form-control input-add" name="coligada" id="coligada">
                                        <option selected value="empresa_1">Empresa 1</option>
                                        <option value="empresa_2">Empresa 2</option>
                                        <option value="empresa_3">Empresa 3</option>
                                        <option value="empresa_4">Empresa 4</option>
                                        <option value="empresa_5">Empresa 5</option>
                                        <option value="empresa_6">Empresa 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Matriz/Filial</strong>
                                        <select class="form-control input-add" name="matriz_filial" id="matriz_filial">
                                            <option selected value="empresa_1">Empresa 1</option>
                                            <option value="empresa_2">Empresa 2</option>
                                            <option value="empresa_3">Empresa 3</option>
                                            <option value="empresa_4">Empresa 4</option>
                                            <option value="empresa_5">Empresa 5</option>
                                            <option value="empresa_6">Empresa 6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Credor</strong>
                                    <select class="form-control input-add" name="credor" id="credor">
                                        <option selected value="credor_1">Credor 1</option>
                                        <option value="credor_2">Credor 2</option>
                                        <option value="credor_3">Credor 3</option>
                                        <option value="credor_4">Credor 4</option>
                                        <option value="credor_5">Credor 5</option>
                                        <option value="credor_6">Credor 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Credor Endereço</strong>
                                    <select class="form-control input-add" name="credor_endereco" id="credor_endereco">
                                        <option selected value="credor_endereco_1">Endereço 1</option>
                                        <option value="credor_endereco_2">Endereço 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Situação</strong>
                                    <select class="form-control input-add" name="status" id="status">
                                        <option selected value="pendente">Pendente</option>
                                        <option value="pago">Pago</option>
                                        <option value="aprovado">Aprovado</option>
                                        <option value="rejeitado">Rejeitado</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Tipo Documento</strong>
                                    <select class="form-control input-add" name="tipo_documento" id="tipo_documento">
                                        <option selected value="boleto">Boleto</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Número</strong>
                                    <input type="text" placeholder="Informe o numero" class="form-control input-add" name="numero_documento" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Série</strong>
                                    <input type="text" placeholder="Série" class="form-control" name="serie_documento" style="width: 58px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Data Emissão</strong>
                                    <input type="date" class="form-control input-add" name="data_emissao" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Moeda</strong>
                                    <select class="form-control input-add" name="moeda" id="moeda">
                                        <option selected value="real">BRL</option>
                                        <option value="dolar">USD</option>
                                        <option value="euro">EUR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%;">
                                <div class="px-5 mb-3">
                                    <strong>Quantidade Parcelas</strong>
                                    <input type="text" class="form-control input-add" name="parcelas" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Centro de custo</strong>
                                    <select class="form-control input-add" name="centro_de_custo" id="centro_de_custo">
                                        <option selected value="centro_de_custo_1">Centro de custo 1</option>
                                        <option value="centro_de_custo_2">Centro de custo 2</option>
                                        <option value="centro_de_custo_3">Centro de custo 3</option>
                                        <option value="centro_de_custo_4">Centro de custo 4</option>
                                        <option value="centro_de_custo_5">Centro de custo 5</option>
                                        <option value="centro_de_custo_6">Centro de custo 6</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%;">
                                <div class="px-5 mb-3">
                                    <strong>Rateio</strong>
                                    <select class="form-control input-add" name="rateio" id="rateio">
                                        <option selected value=""></option>
                                        <option value="rateio_por_item">Por item</option>
                                        <option value="rateio_por_despesa">Pela despesa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <h3>Itens</h3>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlarge">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%; margin: 15px;">
                                <!-- Inicio da tabela de itens -->
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Produto/serviços</th>
                                                <th>Quantidade</th>
                                                <th>Valor Unitário</th>
                                                <th>Rateio</th>
                                                <th>Remover</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">Monitor</td>
                                                <td>10</td>
                                                <td class="text-bold-500">R$150</td>
                                                <td>CERCRED - SOLUÇÕES DE CONTACT CENTER E RECUPERAÇÃO DE CRÉDITO LTDA</td>
                                                <td>
                                                    <!-- mudar a rota -->
                                                    <a href="#" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fim da tabela de itens -->
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Valor Total</strong>
                                    <input type="text" class="form-control" value="R$100.000,00" name="valor" style="width: 120px" readonly>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Adicionar
                                    </button>
                                    <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- fim Tab Despesa -->

                    <!-- inicio Tab Despesa Pessoal -->
                    <div class="tab-pane fade" id="list-despesa-pessoal" role="tabpanel" aria-labelledby="list-despesa-pessoal-list">
                        <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Coligada</strong>
                                    <select class="form-control input-add" name="coligada" id="coligada">
                                        <option selected value="empresa_1">Empresa 1</option>
                                        <option value="empresa_2">Empresa 2</option>
                                        <option value="empresa_3">Empresa 3</option>
                                        <option value="empresa_4">Empresa 4</option>
                                        <option value="empresa_5">Empresa 5</option>
                                        <option value="empresa_6">Empresa 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Matriz/Filial</strong>
                                        <select class="form-control input-add" name="matriz_filial" id="matriz_filial">
                                            <option selected value="empresa_1">Empresa 1</option>
                                            <option value="empresa_2">Empresa 2</option>
                                            <option value="empresa_3">Empresa 3</option>
                                            <option value="empresa_4">Empresa 4</option>
                                            <option value="empresa_5">Empresa 5</option>
                                            <option value="empresa_6">Empresa 6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Funcionário</strong>
                                    <select class="form-control input-add" name="funcionario" id="funcionario">
                                        <option selected value="funcionario_1">Credor 1</option>
                                        <option value="funcionario_2">Funcionário 2</option>
                                        <option value="funcionario_3">Funcionário 3</option>
                                        <option value="funcionario_4">Funcionário 4</option>
                                        <option value="funcionario_5">Funcionário 5</option>
                                        <option value="funcionario_6">Funcionário 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Funcionário Endereço</strong>
                                    <select class="form-control input-add" name="funcionario_endereco" id="funcionario_endereco">
                                        <option selected value="funcionario_endereco_1">Endereço 1</option>
                                        <option value="funcionario_endereco_2">Endereço 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Situação</strong>
                                    <select class="form-control input-add" name="status" id="status">
                                        <option selected value="pendente">Pendente</option>
                                        <option value="pago">Pago</option>
                                        <option value="aprovado">Aprovado</option>
                                        <option value="rejeitado">Rejeitado</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Conta bancária</strong>
                                    <select class="form-control input-add" name="conta_bancaria" id="conta_bancaria">
                                        <option selected value="conta_bancaria_1">Conta Bancária 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo Despesa</strong>
                                    <select class="form-control input-add" name="tipo_despesa" id="tipo_despesa">
                                        <option selected value="reembolso">Reembolso</option>
                                        <option selected value="adiantamento">Adiantamento</option>
                                        <option selected value="salario">Salário</option>

                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Valor</strong>
                                    <input type="text" placeholder="Valor" class="form-control input-add" name="valor" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Data De Pagamento</strong>
                                    <input type="date" class="form-control input-add" name="data_pagamento" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Moeda</strong>
                                    <select class="form-control input-add" name="moeda" id="moeda">
                                        <option selected value="real">BRL</option>
                                        <option value="dolar">USD</option>
                                        <option value="euro">EUR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Adicionar
                                    </button>
                                    <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                                </div>
                        </form>
                    </div>
                    <!-- fim Tab Despesa Pessoal -->
                </div>
                <!--Fim Tabs -->
            </div>
        </div>
    </div>
</div>


<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Selecionar item</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- muda a rota-->
                    <form action="/despesas/adicionar" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>produto</strong>
                                <input class="form-control mt-1" type="text" placeholder="produto" name="produto" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Valor</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="Valor" name="valor_produto" style="width: 358px" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Quantidade</strong>
                                <input class="form-control mt-1" type="text" placeholder="Quantidade" name="quantidade" style="width: 358px" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Selecionar
                        </button>
                        <!-- muda a rota-->
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/js/vendors.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>


@endsection