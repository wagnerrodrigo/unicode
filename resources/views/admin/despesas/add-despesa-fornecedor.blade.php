@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')
    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Despesa </h1>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="justify-content-center " id="list-despesa" style="padding: 10px;">

                        <div class="d-flex mt-10" style="width: 100%">
                            <form action="" name="form_busca_fornecedor" id="form_busca_fornecedor">
                                <div class="px-5 mb-3">
                                    <strong>EMPRESA</strong>
                                    <input type="text" id="busca_empresa" value="" placeholder="Digite o nome da empresa"
                                        autocomplete="off" class="form-control input-busca" name="empresa" />
                                </div>
                            </form>
                        </div>

                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>CENTRO DE CUSTO</strong>
                                <select class="form-control input-busca" name="empresa" id="empresa">
                                    <option selected value="pendente">Pendente</option>
                                    <option value="pago">Pago</option>
                                    <option value="aprovado">Aprovado</option>
                                    <option value="rejeitado">Rejeitado</option>
                                </select>
                            </div>

                        </div>

                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3" style="padding: 8px 12px;">
                                <strong for="input_fornecedor form-check-primary">FORNECEDOR</strong>
                                <input class="form-check-input" checked type="radio" name="tipo_despesa"
                                    id="despesa_fornecedor" value="fornecedor">
                            </div>

                            <div class="px-5 mb-3" style="padding: 8px 12px;">
                                <strong for="input_empregado">EMPREGADO</strong>
                                <input class="form-check-input" type="radio" name="tipo_despesa" id="despesa_empregado"
                                    value="empregado">
                            </div>

                            <div>
                                <button type="button" class="btn btn-primary" id="btnDespesa" style="padding: 8px 12px;"
                                    data-bs-toggle="modal" data-bs-target="#modal-busca">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        <form action="/despesas/adicionar" method="POST">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>CPF/CNPJ</strong>
                                    <input type="text" placeholder="CPF/CNPJ" class="form-control input-add" name="cpf_cnpj"
                                        id="input_cpf_cnpj" readonly />
                                </div>

                                <div class="px-5 mb-3" id="campo_razao_social">
                                    <div>
                                        <strong>NOME/RAZÃO SOCIAL</strong>
                                        <input type="text" placeholder="Razão Social" class="form-control input-add"
                                            name="razao_social" id="input_razao_social" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Classificação</strong>
                                    <select class="form-control input-add" name="classificacao" id="classificacao">
                                        <option value="despesas_C_pessoal">DESPESAS C/ PESSOAL</option>
                                        <option value="despesas_telefonia">DESPESAS TELEFONIA</option>
                                        <option value="despesas_aluguel">DESPESAS ALUGUEL/COND/ENERGIA/AGUA</option>
                                        <option value="despesas_impostos">DESPESAS IMPOSTOS, TAXAS E CONTRIBUIÇÕES</option>
                                        <option value="despesas_juridica">DESPESAS JURÍDICAS</option>
                                        <option value="despesas_depesas">DESPESAS GERAIS</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Tipo</strong>
                                    <select class="form-control input-add" name="tipo_documento" id="tipo_documento">
                                        <option value="despesas_C_pessoal">SALARIOS</option>
                                        <option value="despesas_telefonia">CONSULTAS CADASTRAIS</option>
                                        <option value="despesas_aluguel">ALUGUEL/COND/ENERGIA/AGUA - JF</option>
                                        <option value="despesas_impostos">CONTRIBUIÇÃO SINDICAL</option>
                                        <option value="despesas_juridica">ESTADIA DE VEICULOS</option>
                                        <option value="despesas_depesas">ALUGUEL DE CARROS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="145" rows="2" class="form-control" name="descricao"></textarea>
                                </div>

                            </div>


                            <div class="d-flex"
                                style="width: 100%;justify-content:space-around; align-items:center">
                                <div class="px-5 mb-3">
                                    <h3>Itens</h3>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#xlarge">
                                        <i class="bi bi-plus"></i>
                                    </button>

                                </div>

                                <div class="px-5 mb-3" style="padding-top: 40px">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Salvar
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
                                                    <a href="#" class="btn btn-danger" style="padding: 8px 12px;"><i
                                                            class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                            <input class="form-check-input" type="radio" name="rateio" id="rateio_item"
                                                value="rateio_item">
                                        </div>

                                        <div class="px-5 mb-3 ">
                                            <strong for="input_empregado">Rateio Total</strong>
                                            <input class="form-check-input" type="radio" name="rateio" id="rateio_total"
                                                value="rateio_total">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Valor</strong>
                                    <input type="text" placeholder="Informe o numero" class="form-control input-add"
                                        name="numero_documento" />
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
        <div class="modal fade text-left" id="modal-busca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
            aria-hidden="true">
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
                                <div class="ResultadoCnpjCpf input-add" id="ResultadoCnpjCpf"></div>
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

    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendors.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>


@endsection
