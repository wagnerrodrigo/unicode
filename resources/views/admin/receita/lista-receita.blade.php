@extends('layouts.templates.template')
@section('title', 'Lista Receita')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Receita</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Nova Receita
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
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Nova Receita</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('receitas')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Coligada</strong>
                                <select class="form-control input-add" name="coligada" id="coligada">
                                    <option selected value="coligada_1">Coligada 1</option>
                                    <option value="coligada_2">Coligada 2</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Matriz/Filial</strong>
                                    <select class="form-control input-add" name="matriz_filial" id="matriz_filial">
                                        <option selected value="filial_1">Filial 1</option>
                                        <option value="filial_2">Filial 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Devedor</strong>
                                <select class="form-control input-add" name="devedor" id="devedor">
                                    <option selected value="devedor_1">Devedor 1</option>
                                    <option value="devedor_2">Devedor 2</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Endereço Devedor</strong>
                                <select class="form-control input-add" name="endereco_devedor" id="endereco_devedor">
                                    <option selected value="endereco_devedor_1">Endereço 1</option>
                                    <option value="endereco_devedor_2">Endereço 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Situação Documento</strong>
                                <select class="form-control input-add" name="situacao_documento" id="situacao_documento">
                                    <option selected value="situacao_1">Situação 1</option>
                                    <option value="situacao_2">Situação 2</option>
                                </select>
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Tipo Documento</strong>
                                <select class="form-control input-add" name="tipo_documento" id="tipo_documento">
                                    <option selected value="tipo_1">Tipo 1</option>
                                    <option value="tipo_2">Tipo 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Número</strong>
                                <input class="form-control input-add" type="text" name="numero_documento" placeholder="Número" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Série</strong>
                                <input class="form-control" type="text" name="serie" placeholder="serie" style="width: 58px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Data Emissão</strong>
                                <input class="form-control input-add" type="date" name="data" placeholder="data" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Moeda</strong>
                                <select class="form-control input-add" name="moeda" id="moeda">
                                    <option selected value="brl">BRL</option>
                                    <option value="usd">USD</option>
                                    <option value="eur">EUR</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Valor total</strong>
                                <input class="form-control input-add" type="text" name="valor_total" value="0" readonly />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Quantidade Parcelas</strong>
                                <input class="form-control input-add" type="text" name="parcelas" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Descrição</strong>
                                <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('receitas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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
<script src="assets/js/app.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection