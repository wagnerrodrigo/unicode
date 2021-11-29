
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
                        <form action="" name="form_busca_fornecedor" id="form_busca_fornecedor">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input type="text" id="busca_empresa" value="" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" name="empresa" />
                                <div id="results_empresa" class="resultado-busca"></div>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
                            <select class="form-control input-busca" name="empresa" id="empresa">
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

                    <form action="/despesas/adicionar" method="POST">
                        @csrf
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
                                <strong>Classificação</strong>
                                <input class="form-control input-add teste" name="classificacao" id="classificacao_con" readonly/>
                                <div id="itens_classificacao" class="input-style"></div>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Tipo</strong>
                                <select class="form-control input-add" name="tipo_classificacao" id="tipo_classificacao">
                                </select>
                            </div>
                        </div>



                     
                        <div class="d-flex" style="width: 100%; align-items:center">
                            <div class="px-5 mb-3">
                                <h3>Itens </h3>
                                <button class="btn btn-primary" type="button" id="Prod">
                                    <i class="bi bi-plus"></i>produto
                                </button>
                                {{-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlargeServico">
                                    <i class="bi bi-plus"></i>serviço
                                </button> --}}
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
                                    <tbody id="Tb" >
                                        <td class="inserirProd_Ser">
                                                <div>
                                                    <input class="form-control mt-1" type="text" autocomplete="off" required id="classificacao_prod" placeholder="Produto ou Servico" name="classificacao_produto" style="width: 188px" />
                                                    <div id="classificacao_tipo_produto" class="input-style"></div>
                                                </div>
                                        </td> 

                                        <td class="inserirQuant">
                                            <div>
                                                <select class="form-control input-add" id="produto_servico" placeholder="Produto ou Servico" required name="produto_servico" style="width: 190px" ></select>
                                            </div>
                                        </td> 

                                        <td class="inserirValor">
                                            <div>
                                                <input class="form-control mt-1" id="valor_item" type="text" autocomplete="off" placeholder="Valor" required name="complemento" style="width: 70px" /></div>
                                        </td> 
                                        
                                        <td class="inserirDesc">
                                            <div>
                                                <input class="form-control mt-1" id="quantidade" type="text" autocomplete="off" placeholder="Quantidade" required name="quantidade" style="width: 70px" />
                                            </div>
                                        </td> 
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <!-- Fim da tabela de itens -->
                        </div>

                        <br>
                        <hr>
                        <hr>
                        <br>


                        <div class="d-flex" style="width: 100%;">
                            <div class="px-5 mb-3">
                                <div class="d-flex mt-10" style="width: 100%">
                                    <strong>Rateio</strong>
                                </div>

                                <div class="d-flex mt-10" style="width: 100%">
                                    <div class="px-5 mb-3">
                                        <strong for="input_fornecedor form-check-primary">Rateio por item</strong>
                                        <input class="form-check-input" type="radio" name="rateio" id="rateio_item" value="rateio_item">
                                    </div>

                                    <div class="px-5 mb-3 ">
                                        <strong for="input_empregado">Rateio Total</strong>
                                        <input class="form-check-input" type="radio" name="rateio" id="rateio_total" value="rateio_total">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Valor</strong>
                                <input type="text" id="valor_total" placeholder="Informe o numero" class="form-control input-add" name="numero_documento" />
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
                                <strong>Quantidade Parcelas</strong>
                                <input type="text" class="form-control input-add" name="parcelas" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Forma de Pagamento</strong>
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
                                <strong>Tipo de Documento</strong>
                                <input type="text" class="form-control input-add" name="tipo_documento" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Numero da nota ou Documento</strong>
                                <input type="text" class="form-control input-add" name="numero_nota_documento" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%;">
                            <div class="px-5 mb-3">
                                <strong>Data de vencimento</strong>
                                <input type="date" class="form-control input-add" name="data_vencimento" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Data de provisionamento</strong>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Produto</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- mudar a rota --}}
                    <form   style="padding: 10px;">
                        @csrf
                     
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="Button" id="btn_Adicionar_produto" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        {{-- mudar a rota --}}
                        <a  class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->




<!-- Inicio Modal Adicionar SERVIÇO-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlargeServico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Novo Serviço</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- mudar a rota --}}
                    <form   style="padding: 10px;">
                        @csrf
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Classificação</strong>
                                <input class="form-control mt-1" type="text" id="classificacao_serv" placeholder="Produto ou Servico" name="class_Servico" style="width: 200px" />
                                <div id="classificacao_tipo_servico" class="input-style"></div>
                            </div>
                                    
                            <div class="px-5 mb-3">
                                <strong>Serviço</strong>
                                <select class="form-control input-add"  id="servico" placeholder="Produto ou Servico" name="servico" style="width: 208px" ></select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Valor do item</strong>
                                <input class="form-control mt-1" id="valor_Servico" type="text" placeholder="Valor do item" name="valor_Servico" style="width: 150px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Quantidade</strong>
                                <input class="form-control mt-1" id="quantidade_Servico" type="text" placeholder="Quantidade do item" name="quantidade_Servico" style="width: 150px" />
                            </div>

                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Descrição</strong>
                                <textarea cols="145" rows="1" class="form-control" id="descricao" type="text" placeholder="Descrição" name="descricao" style="width: 850px"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="Button" id="btnAdicionar" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        {{-- mudar a rota --}}
                        <a  class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar SERVIÇO-->


<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/vendors.js') }}"></script>

<script src="{{ asset('assets/js/vendors.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>

@endsection
