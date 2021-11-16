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
                        <div class="px-5 mb-3">
                            <strong>EMPRESA</strong>
                            <select class="form-control input-add" name="empresa" id="empresa">
                                <option selected value="pendente">Pendente</option>
                                <option value="pago">Pago</option>
                                <option value="aprovado">Aprovado</option>
                                <option value="rejeitado">Rejeitado</option>
                            </select>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
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
                                <input type="text" placeholder="CPF/CNPJ" class="form-control input-add" name="cpf_cnpj" readonly />
                            </div>

                            <div class="px-5 mb-3" id="campo_razao_social">
                                <div>
                                    <strong>NOME/RAZÃO SOCIAL</strong>
                                    <input type="text" placeholder="Razão Social" class="form-control input-add" name="razao_social" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Representante Legal</strong>
                                <input type="text" placeholder="Informe o numero" class="form-control input-add" name="representante" readonly />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Cpf do Representante Legal</strong>
                                <input type="text" placeholder="Informe o numero" class="form-control input-add" name="cpf_representante" readonly />
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

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Valor</strong>
                                <input type="text" placeholder="Informe o numero" class="form-control input-add" name="numero_documento" />
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
                                <strong>Data de vencimento</strong>
                                <input type="date" class="form-control input-add" name="data_vencimento" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%;">
                            <div class="px-5 mb-3">
                                <strong>Forma de Pagamento</strong>
                                <select class="form-control input-add" name="forma_pagamento" id="forma_pagamento">
                                    <option value="boleto">Boleto</option>
                                    <option value="pix">Pix</option>
                                    <option value="deposito_conta">Deposito em conta</option>
                                    <option value="transferencia">Transferencia em conta</option>
                                </select>
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Data de provisionamento</strong>
                                <input type="date" class="form-control input-add" name="data_provisionamento" />
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

                <form action="/fornecedores" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <strong id="tipo-documento"></strong>
                            <input type="text" class="form-control" id="cnpj_fornecedor" name="cnpj">
                        </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnDespesa">
                        Selecionar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/js/vendors.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script>
    //Seleciona quais campos irão aparecer na tela
    $(document).ready(function() {
        $('input:radio[name="seleciona_tela"]').on("change", function() {
            if (this.checked && this.value == '1') {
                $("#campo_razao_social").show();
                $("#input-custom-field4, #input-custom-field5, #input-custom-field6").hide();
            } else {
                $("#input-custom-field4, #input-custom-field5, #input-custom-field6").show();
                $("#campo_razao_social").hide();
            }
        });
    });
</script>

<script>
    //seleciona tipo de despesa
    document.getElementById("btnDespesa").onclick = function() {
        var radios = document.getElementsByName("tipo_despesa");
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == "fornecedor") {
                    document.getElementById("titulo-modal").innerHTML = "Adicionar Fornecedor";
                    document.getElementById("tipo-documento").innerHTML = "CNPJ/CPF";
                }
                if (radios[i].value == "empregado") {
                    document.getElementById("tipo-documento").innerHTML = "CPF";
                }
            }
        }
    };
</script>

@endsection
