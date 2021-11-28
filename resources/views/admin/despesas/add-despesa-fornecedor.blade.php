@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Despesa</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <div class="justify-content-center " id="list-despesa" style="padding: 10px;">

                    <div class="d-flex mt-10" style="width: 100%">
                        <form action="/despesas" method="POST">
                            @csrf
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input type="text" id="busca_empresa" value="" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" name="nome_empresa" />
                                <div id="results_empresa" class="resultado-busca"></div>
                                <!--serve somente para armazenar o id da empresa selecionada-->
                                <input type="hidden" id="id_busca_empresa" name="id_empresa"></input>
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
                        </div>

                        <div class="px-5 mb-3" id="campo_razao_social">
                            <div>
                                <strong>NOME/RAZÃO SOCIAL</strong>
                                <input type="text" placeholder="Razão Social" class="form-control input-add" name="razao_social" id="input_razao_social" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
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


                    <div class="d-flex" style="width: 100%;justify-content:flex-start; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>ITENS</h3>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlarge">
                                <i class="bi bi-plus"></i>
                            </button>

                        </div>
                    </div>

                    <!-- Inicio da div da tabela de itens -->
                    <div class="d-flex" style="width: 100%; margin: 15px;">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>PRODUTOS/SERVIÇOS</th>
                                        <th>QUANTIDADE</th>
                                        <th>VALOR UNITÁRIO</th>
                                        <th>RATEIO</th>
                                        <th>REMOVER</th>
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

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>QUANTIDADE PARCELAS</strong>
                            <input type="text" class="form-control input-add" name="parcelas" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>FORMA DE PAGAMENTO</strong>
                            <select class="form-control input-add" name="forma_pagamento" id="forma_pagamento">
                                <option value="boleto">Boleto</option>
                                <option value="pix">Pix</option>
                                <option value="deposito_conta">Deposito em conta</option>
                                <option value="transferencia">Transferencia em conta</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>TIPO DE DOCUMENTO</strong>
                            <input type="text" class="form-control input-add" name="tipo_documento" />
                        </div>
                        <div class="px-5 mb-3">
                            <strong>NUMERO DA NOTA OU DOCUMENTO</strong>
                            <input type="text" class="form-control input-add" name="numero_nota_documento" />
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
                                <tbody>
                                    <tr>
                                        <td class="text-bold-500">CERCRED - CENTRAL DE RECUPERAÇÃO DE CRÉDITO LTDA - JUIZ DE FORA </td>
                                        <td class="text-bold-500">GERENCIA TECNOLOGIA</td>
                                        <td>TOTAL</td>
                                        <td>100%</td>
                                        <td>
                                            <!-- mudar a rota -->
                                            <a href="#" class="btn btn-warning" style="padding: 8px 12px;"><i class="bi bi-pencil-fill"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Fim da div da tabela de rateio -->

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


<div class="modal-primary me-1 mb-1 d-inline-block">
    <!--primary theme Modal -->
    <div class="modal fade text-left" id="modal-busca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="titulo-modal"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <strong id="tipo-documento"></strong>
                            <input type="text" class="form-control" id="Cnpj_Cpf" name="cnpj">
                            <div class="ResultadoCnpjCpf input-add" id="ResultadoCnpjCpf" value=""></div>
                        </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnCnpj_Cpf">
                        Selecionar
                    </button>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Endereço</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- mudar a rota --}}
                    <form action="/enderecos" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Produto/Serviço</strong>
                                <input class="form-control mt-1" type="text" id="produto_servico" placeholder="Produto ou Servico" name="produto_servico" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Valor do item</strong>
                                <input class="form-control mt-1" id="valor_item" type="text" placeholder="Valor do item" name="complemento" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">

                            <div class="px-5 mb-3">
                                <strong>Quantidade</strong>
                                <input class="form-control mt-1" id="quantidade" type="text" placeholder="Quantidade do item" name="bairro" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Descrição</strong>
                                <textarea cols="145" rows="1" class="form-control" type="text" placeholder="Descrição" name="descricao" style="width: 358px"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        {{-- mudar a rota --}}
                        <a href="{{route('adicionar-despesa')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->


<!-- Inicio Modal Adicionar-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Novo Rateio</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>EMPRESA</strong>
                            <input class="form-control input-busca" type="text" id="rateio_empresa" autocomplete="off" placeholder="Empresa" name="rateio_empresa" style="width: 60rem" />
                            <div id="results_rateio_empresa" class="resultado-busca-rateio"></div>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
                            <select class="form-control input-add" name="centro_custo_rateio" id="custo_rateio">
                                <option selected value="" class="resultado-busca"></option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Produto/Serviço</strong>
                            <input class="form-control mt-1" type="text" id="produto_servico" placeholder="Produto ou Servico" name="produto_servico" style="width: 358px" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>VALOR RATEADO</strong>
                            <input class="form-control mt-1" id="valor_item_rateado" type="text" onkeypress="return onlynumber(); " placeholder="Valor do item" name="complemento" style="width: 358px" />
                        </div>
                        <div class="d-flex flex-row" style="width: 100%; align-items:center">
                            <div>
                                <input class="form-control mt-1" id="porcentagem_valor" type="text" min="0" max="3" onkeyup="return validateValue(this);" onkeypress="return onlynumber();" maxlength=3 name="porcentagem_rateado" style="width: 58px" />
                            </div>

                            <div>
                                <strong>%</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('adicionar-despesa')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
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

@endsection
