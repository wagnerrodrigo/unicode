@extends('layouts.templates.template')
@section('title', 'Lista Contratos')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Lista Contratos</h1>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                    <i class="bi bi-plus-circle"></i> Novo Contrato
                </button>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Setor</th>
                            <th>Empresa</th>
                            <th>Fornecedor</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Data inicio</th>
                            <th>Data fim</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Telecom</td>
                            <td>Empresa Teste</td>
                            <td>OI S.A</td>
                            <td>Serviço de telefonia</td>
                            <td>Vigente</td>
                            <td>05/02/2021</td>
                            <td>15/12/2021</td>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Contrato</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Setor</strong>
                                <input class="form-control mt-1" type="text" placeholder="Setor" name="setor" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Empresa</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="Empresa" name="empresa" style="width: 358px" />
                                </div>
                            </div>
                        </div>


                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Fornecedor</strong>
                                <select class="form-control" name="fornecedor" id="fornecedor" style="width: 358px">
                                    <option selected value="fornecedor_1">Fornecedor 1</option>
                                    <option value="fornecedor_2">Fornecedor 2</option>
                                    <option value="fornecedor_3">Fornecedor 3</option>
                                    <option value="fornecedor_4">Fornecedor 4</option>
                                    <option value="fornecedor_5">Fornecedor 5</option>
                                    <option value="fornecedor_6">Fornecedor 6</option>
                                </select>
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Descricao do Serviço</strong>
                                <input class="form-control mt-1" type="text" placeholder="Descricao do Serviço" name="descricao_do_servico" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Local</strong>
                                <input class="form-control mt-1" type="text" placeholder="Local" name="local" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Status</strong>
                                <select class="form-control" name="fornecedor" id="fornecedor" style="width: 358px">
                                    <option selected value="vigente">Vigente</option>
                                    <option value="cancelado">Cancelado</option>
                                    <option value="encerrado">Encerrado</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">

                            <div class="px-5 mb-3">
                                <strong>Data inicio</strong>
                                <input class="form-control mt-1" type="date" placeholder="Data inicio" name="data_inicio" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Data fim</strong>
                                <input class="form-control mt-1" type="date" placeholder="Data fim" name="data_fim" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">

                            <div class="px-5 mb-3">
                                <strong>Data Assinatura</strong>
                                <input class="form-control mt-1" type="date" placeholder="Data assinatura" name="data_assinatura" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Valor contrato</strong>
                                <input class="form-control mt-1" type="text" placeholder="Valor contrato" name="valor_contrato" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Dia Pagamento</strong>
                                <input class="form-control mt-1" type="text" placeholder="Dia Pagamento" name="dia_pagamento" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Juros Multa/Atraso</strong>
                                <input class="form-control mt-1" type="text" placeholder="Multa/atraso" name="juros" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Multa Recisória</strong>
                                <input class="form-control mt-1" type="text" placeholder="Multa Recisória" name="multa_recisoria" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Observação</strong>
                                <input class="form-control mt-1" type="text" placeholder="Observação" name="observacao" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Diretor Assinante</strong>
                                <input class="form-control mt-1" type="text" placeholder="Diretor Assinante" name="diretor_assinante" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Diretor Autorizador</strong>
                                <input class="form-control mt-1" type="text" placeholder="Diretor Autorizador" name="diretor_autorizador" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Prazo de Vigencia</strong>
                                <input class="form-control mt-1" type="text" placeholder="Prazo de Vigencia" name="prazo_vigencia" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Periodicidade</strong>
                                <input class="form-control mt-1" type="text" placeholder="Periodicidade" name="periodicidade_pagamento" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Forma Pagamento</strong>
                                <input class="form-control mt-1" type="text" placeholder="Forma Pagamento" name="forma_pagamento" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Carência</strong>
                                <input class="form-control mt-1" type="text" placeholder="Carência" name="carencia" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Nome Representante</strong>
                                <input class="form-control mt-1" type="text" placeholder="Nome Representante" name="nome_representante" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Contato Representante</strong>
                                <input class="form-control mt-1" type="text" placeholder="Contato Representante" name="contato_representante" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Recisão antecipada</strong>
                                <input class="form-control mt-1" type="text" placeholder="Recisão antecipada" name="recisao_antecipada" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Prazo Recisão</strong>
                                <input class="form-control mt-1" type="text" placeholder="Prazo Recisão" name="prazo_recisao" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                           
                            <div class="px-5 mb-3">
                                <strong>PDF contrato</strong>
                                <input class="form-control mt-1" type="file" name="contrato" style="width: 358px" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('contratos')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
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