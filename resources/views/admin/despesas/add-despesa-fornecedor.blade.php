@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Despesa</h1>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="justify-content-center" id="list-despesa" style="padding: 10px;">
                    <div class="d-flex mt-10" style="width: 100%">
                        <form action="/despesas" method="POST">
                            @csrf
                            <div id="hidden_inputs"></div>
                            <div id="hidden_inputs_itens"></div>
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input type="text" id="busca_empresa" value="" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" />
                                <div id="results_empresa" class="resultado-busca"></div>
                                <!--serve somente para armazenar o id da empresa selecionada-->
                                <input type="hidden" id="id_busca_empresa"></input>
                                <!-- ### -->
                            </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
                            <select class="form-control input-busca" name="centro_custo_empresa" id="empresa">
                                <option selected value="" class="resultado-busca"></option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3" style="padding: 8px 12px;">
                            <strong for="input_fornecedor form-check-primary">FORNECEDOR</strong>
                            <input class="form-check-input" checked type="radio" name="tipo_despesa" id="despesa_fornecedor" value="fornecedor">
                        </div>

                        <div class="px-5 mb-3" style="padding: 8px 12px;">
                            <strong for="input_empregado">EMPREGADO</strong>
                            <input class="form-check-input" type="radio" name="tipo_despesa" id="despesa_empregado" value="empregado">
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" id="btnDespesa" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#modal-busca">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CPF/CNPJ</strong>
                            <input type="text" placeholder="CPF/CNPJ" class="form-control input-add" name="cpf_cnpj" id="input_cpf_cnpj" readonly />
                            <input type="hidden" name="fk_empregado_fornecedor" id="fk_empregado_fornecedor">
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3" id="campo_razao_social">
                                <strong>NOME/RAZÃO SOCIAL</strong>
                                <input type="text" placeholder="Razão Social" class="form-control input-add" name="razao_social" id="input_razao_social" readonly />
                            </div>
                        </div>
                    </div>


                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CLASSIFICAÇÃO</strong>
                            <input class="form-control input-add teste" name="classificacao" id="classificacao_con" readonly></input>
                            <div id="itens_classificacao" class="input-style"></div>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>TIPO</strong>
                            <select class="form-control input-add" name="tipo_classificacao" id="tipo_classificacao">
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>DESCRIÇÃO</strong>
                            <textarea cols="145" rows="2" class="form-control" name="descricao"></textarea>
                        </div>

                    </div>

                    <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>Itens </h3>
                            <button class="btn btn-primary" type="button" id="Prod">
                                <i class="bi bi-plus"></i>produto
                            </button>
                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlargeServico"> -->
                            <!-- <i class="bi bi-plus"></i>serviço -->
                            <!-- </button>  -->
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%; margin: 15px;">
                        <!-- Inicio da tabela de itens -->
                        <div class="px-5 mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Classificação</th>
                                            <th>Produto</th>
                                            <th>Valor Unitario</th>
                                            <th>Quantidade</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tb">
                                        <td class="inserirProd_Ser">
                                            <div>
                                                <input class="form-control mt-1" type="text" autocomplete="off" id="classificacao_prod" placeholder="Produto ou Servico" style="width: 188px" />
                                                <div id="classificacao_tipo_produto" class="input-style"></div>
                                            </div>
                                        </td>

                                        <td class="inserirQuant">
                                            <div>
                                                <select class="form-control input-add" id="produto_servico" placeholder="Produto ou Servico" style="width: 190px"></select>
                                            </div>
                                        </td>

                                        <td class="inserirValor">
                                            <div>
                                                <input class="form-control mt-1" id="valor_item" type="text" autocomplete="off" placeholder="Valor" style="width: 70px" />
                                            </div>
                                        </td>

                                        <td class="inserirDesc">
                                            <div>
                                                <input class="form-control mt-1" id="quantidade" type="text" autocomplete="off" placeholder="Quantidade" style="width: 70px" />
                                            </div>
                                        </td>
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Fim da tabela de itens -->
                    </div>

                    <!-- Fim da div da tabela de itens -->

                    <br>
                    <hr>
                    <br>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>VALOR</strong>
                            <input type="text" placeholder="Informe o numero" class="form-control input-add" name="valor_total" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>MOEDA</strong>
                            <select class="form-control input-add" name="moeda" id="moeda">
                                <option selected value="real">BRL</option>
                                <option value="dolar">USD</option>
                                <option value="euro">EUR</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <div class="d-flex" style="width: 100%;justify-content:start; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>RATEIO</h3>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xrateio">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Inicio da div da tabela de rateio -->
                    <div class="d-flex" style="width: 100%; margin: 15px;">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>EMPRESA</th>
                                        <th>CENTRO DE CUSTO</th>
                                        <th>RATEIO</th>
                                        <th>%</th>
                                        <th>EDITAR</th>
                                    </tr>
                                </thead>

                                <tbody id="table_rateio">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Fim da div da tabela de rateio -->

                    <br>
                    <hr>
                    <br>
                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>QUANTIDADE PARCELAS</strong>
                            <input type="text" class="form-control input-add" name="parcelas" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>CONDIÇÃO DE PAGAMENTO</strong>
                            <select class="form-control input-add" name="condicao_pagamento" id="condicao_pagamento">

                            </select>
                        </div>
                    </div>



                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>NUMERO DA NOTA OU DOCUMENTO</strong>
                            <input type="text" class="form-control input-add" name="numero_nota_documento" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>SERIE</strong>
                            <input type="text" class="form-control input-add" name="serie_documento" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>TIPO DE DOCUMENTO</strong>
                            <input type="text" class="form-control input-add" name="tipo_documento" />
                        </div>
                        <div class="px-5 mb-3">
                            <strong>DATA DE EMISSÃO</strong>
                            <input type="date" class="form-control input-add" name="data_emissao" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%;">
                        <div class="px-5 mb-3">
                            <strong>DATA DE VENCIMENTO</strong>
                            <input type="date" class="form-control input-add" name="data_vencimento" />
                        </div>
                        <div class="px-5 mb-3">
                            <strong>DATA DE PROVISIONAMENTO</strong>
                            <input type="date" class="form-control input-add" name="data_provisionamento" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-1 mb-1">
                                <i data-feather="check-circle"></i>Adicionar
                            </button>
                            <a href="{{ route('despesas') }}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal de busca de empregado/fornecedor-->
<div class="modal-primary me-1 mb-1 d-inline-block">
    <div class="modal fade text-left" id="modal-busca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="titulo-modal"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <strong id="tipo-documento"></strong>
                        <input type="text" class="form-control" id="Cnpj_Cpf" autocomplete="off">
                        <div class="ResultadoCnpjCpf input-add" id="ResultadoCnpjCpf" value=""></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btnCnpj_Cpf">
                            Selecionar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Inicio Modal Adicionar-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Novo Produto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="Button" id="btn_Adicionar_produto" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<!-- Inicio Modal Rateio-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Novo Rateio</h4>

                    <div>
                        <span>Valor Total: </span>
                        <input class="input-add" type="text" id="modal_valor_total" name="modal_valor_total" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple">
                    </div>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>EMPRESA</strong>
                            <input class="form-control input-busca" type="text" id="rateio_empresa" autocomplete="off" placeholder="Empresa" style="width: 60rem" />
                            <div id="results_rateio_empresa" class="resultado-busca-rateio"></div>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
                            <select class="form-control input-add" id="custo_rateio">
                                <option selected value="" class="resultado-busca"></option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>VALOR RATEADO</strong>
                            <input class="form-control mt-1" id="valor_rateado" type="text" onkeypress="return onlynumber(); " placeholder="Valor do item" style="width: 358px" />
                        </div>
                        <div class="d-flex flex-row" style="width: 100%; align-items:center">
                            <div>
                                <input class="form-control mt-1" id="porcentagem_rateado" type="text" min="0" max="3" onkeyup="return validateValue(this);" onkeypress="return onlynumber();" maxlength="3" style="width: 58px" />
                            </div>

                            <div>
                                <strong>%</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-success me-1 mb-1" type="button" id="seleciona_rateio">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('adicionar-despesa')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->


<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/vendors.js') }}"></script>

<script src="{{ asset('assets/js/vendors.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/rateio.js') }}"></script>

@endsection
