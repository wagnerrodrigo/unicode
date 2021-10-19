@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Despesas</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#despesas">
                    <i class="bi bi-plus-circle"></i> Nova Despesa
                </button>

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#despesas-pessoal">
                    <i class="bi bi-plus-circle"></i> Nova Despesa com Pessoal
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Valor das Parcelas</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>R$300,00</td>
                            <td>3</td>
                            <td>R$100,00</td>
                            <td>16/10/2021</td>
                            <td>A pagar</td>
                            <td>
                                <form method="GET" action="/fornecedores/1" data-bs-toggle="modal" data-bs-target="#xlarge-view" class="btn btn-primary" style="padding: 8px 12px;">
                                    @csrf
                                    <i class="bi bi-eye-fill"></i>
                                </form>
                                <a href="{{route('cadastro-fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal Adicionar-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="despesas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Nova Despesa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Coligada</strong>
                                <select class="form-control" name="coligada" id="coligada" style="width: 358px">
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
                                    <select class="form-control" name="matriz_filial" id="matriz_filial" style="width: 358px">
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
                                <select class="form-control" name="credor" id="credor" style="width: 358px">
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
                                <select class="form-control" name="credor_endereco" id="credor_endereco" style="width: 358px">
                                    <option selected value="credor_endereco_1">Endereço 1</option>
                                    <option value="credor_endereco_2">Endereço 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Situação</strong>
                                <select class="form-control" name="status" id="status" style="width: 358px">
                                    <option selected value="pendente">Pendente</option>
                                    <option value="pago">Pago</option>
                                    <option value="aprovado">Aprovado</option>
                                    <option value="rejeitado">Rejeitado</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Tipo Documento</strong>
                                <select class="form-control" name="tipo_documento" id="tipo_documento" style="width: 358px">
                                    <option selected value="boleto">Boleto</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Número</strong>
                                <input type="text" placeholder="Informe o numero" class="form-control" name="numero_documento" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Série</strong>
                                <input type="text" placeholder="Série" class="form-control" name="serie_documento" style="width: 58px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Data Emissão</strong>
                                <input type="date" class="form-control" name="data_emissao" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Moeda</strong>
                                <select class="form-control" name="moeda" id="moeda" style="width: 358px">
                                    <option selected value="real">BRL</option>
                                    <option value="dolar">USD</option>
                                    <option value="euro">EUR</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Quantidade Parcelas</strong>
                                <input type="text" class="form-control" name="parcelas" style="width: 358px" />
                            </div>
                        </div>

                        <h3>Itens</h3>
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Produto/serviços</strong>
                                <select class="form-control" name="produto" id="produto" style="width: 358px">
                                    <option selected value="produto_1">Produto 1</option>
                                    <option value="produto_2">Produto 2</option>
                                    <option value="produto_3">Produto 3</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Classificação Contábil</strong>
                                <select class="form-control" name="class_contabil" id="class_contabil" style="width: 358px">
                                    <option selected value="class_1">Classificação 1</option>
                                    <option value="class_2">Classificação 2</option>
                                    <option value="class_3">Classificação 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Quantidade</strong>
                                <input type="text" class="form-control" name="quantidade" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Valor Unitário</strong>
                                <input type="text" class="form-control" name="valor_unitario" style="width: 358px">
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Centro de custos</strong>
                                <select class="form-control" name="centro_custo" id="centro_custo" style="width: 358px">
                                    <option selected value="centro_custo_1">Centro Custo 1</option>
                                    <option value="centro_custo_2">Centro Custo 2</option>
                                    <option value="centro_custo_3">Centro Custo 3</option>
                                </select>
                            </div>
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
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar Despesa -->

<!-- Inicio modal Despesa Pessoal -->
<div class="modal fade text-left w-100" id="despesas-pessoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Nova Despesa com Pessoal</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x" data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                    @csrf
                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Coligada</strong>
                            <select class="form-control" name="coligada" id="coligada" style="width: 358px">
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
                                <select class="form-control" name="matriz_filial" id="matriz_filial" style="width: 358px">
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
                            <select class="form-control" name="funcionario" id="funcionario" style="width: 358px">
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
                            <select class="form-control" name="funcionario_endereco" id="funcionario_endereco" style="width: 358px">
                                <option selected value="funcionario_endereco_1">Endereço 1</option>
                                <option value="funcionario_endereco_2">Endereço 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Situação</strong>
                            <select class="form-control" name="status" id="status" style="width: 358px">
                                <option selected value="pendente">Pendente</option>
                                <option value="pago">Pago</option>
                                <option value="aprovado">Aprovado</option>
                                <option value="rejeitado">Rejeitado</option>
                            </select>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Tipo Documento</strong>
                            <select class="form-control" name="tipo_documento" id="tipo_documento" style="width: 358px">
                                <option selected value="boleto">Boleto</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Número</strong>
                            <input type="text" placeholder="Informe o numero" class="form-control" name="numero_documento" style="width: 358px" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Série</strong>
                            <input type="text" placeholder="Série" class="form-control" name="serie_documento" style="width: 58px" />
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>Data Emissão</strong>
                            <input type="date" class="form-control" name="data_emissao" style="width: 358px" />
                        </div>

                        <div class="px-5 mb-3">
                            <strong>Moeda</strong>
                            <select class="form-control" name="moeda" id="moeda" style="width: 358px">
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
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-1 mb-1">
                                <i data-feather="check-circle"></i>Adicionar
                            </button>
                            <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Fim modal Adicionar -->
<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection