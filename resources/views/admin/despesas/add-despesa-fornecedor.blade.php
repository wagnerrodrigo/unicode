@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>CADASTRAR DESPESA</h1>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="justify-content-center" id="list-despesa" style="padding: 10px;">
                    <div class="d-flex mt-10" style="width: 100%">
                        <form action="/despesas" method="POST" id="form_despesa">
                            @csrf
                            <div id="hidden_inputs"></div>
                            <div id="hidden_inputs_itens"></div>
                            <div id="hidden_inputs_parcelas"></div>
                            <input type="hidden" name="id_empresa_selecionada" id="id_busca_empresa" />
                            <input type="hidden" name="numero_processo" value="">

                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input required type="text" id="busca_empresa" value="" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" />
                                <div id="results_empresa" class="resultado-busca"></div>
                            </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO PRINCIPAL</strong>
                            <select class="form-control input-busca" name="centro_custo_empresa" id="empresa" style="cursor: pointer;">
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
                            <input required type="text" placeholder="CPF/CNPJ" class="form-control input-add" name="cpf_cnpj" id="input_cpf_cnpj" readonly />
                            <input type="hidden" name="fk_empregado_fornecedor" id="fk_empregado_fornecedor">
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3" id="campo_razao_social">
                                <strong>NOME/RAZÃO SOCIAL</strong>
                                <input required type="text" placeholder="Razão Social" class="form-control input-add" name="razao_social" id="input_razao_social" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>CLASSIFICAÇÃO</strong>
                            <input required class="form-control input-add" name="classificacao" id="classificacao_con" readonly style="cursor: pointer;"></input>
                            <div id="itens_classificacao" class="input-style" style="cursor: pointer;"></div>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>TIPO</strong>
                            <select required class="form-control input-add" name="tipo_classificacao" id="tipo_classificacao" style="cursor: pointer;">
                            </select>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3" id="despesa_juridica">
                            <!-- CAMPO DE DESPESA JURIDICA -->
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <strong>TITULO</strong>
                            <input required name="titulo_despesa" maxlength="100" class="form-control input-busca"></input>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>ITENS</h3>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%; margin: 15px;">
                        <!-- Inicio da tabela de itens -->
                        <div class="px-5 mb-3">
                            <div class="table-responsive">
                                <div class="d-flex flex-row" style="padding:17px; align-items:center; border: 1px solid #ccc">
                                    <div class="inserirProd_Ser" info-geral="Categoria" style="padding:15px">
                                        <select class="form-control mt-1" id="classificacao_tipo_produto">
                                            <option selected value=""></option>
                                        </select>
                                    </div>

                                    <div class="inserirQuant" info-categoria="Produto ou Serviço" style="padding:15px">
                                        <select class="form-control input-add mt-1" id="produto_servico" placeholder="Produto ou Servico" style="width: 190px"></select>
                                    </div>

                                    <div class="inserirValor" style="padding:15px">
                                        <input class="form-control mt-1" id="valor_item" onkeyup="formataValor(this)" max="3" type="text" onblur="verificaValor(this)" type="text" class="dinheiro" autocomplete="off" placeholder="Valor" style="width: 180px" />
                                        <span id="erro_valor_item"></span>
                                    </div>

                                    <div class="inserirDesc" style="padding:15px">
                                        <input class="form-control mt-1" id="quantidade" type="text" onkeyup="return onlynumber();" onblur="validaqtdItem(this)" autocomplete="off" placeholder="Quantidade" style="width: 180px" />
                                    </div>
                                    <div style="padding:15px">
                                        <button class="btn btn-primary" type="button" id="Prod" style="width: 2.5rem; padding: 6.5px; margin-top: 3px">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                    <div id="acao_dados" style="display:none;"></div>
                                </div>
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>CLASSIFICAÇÃO</th>
                                            <th>PRODUTO</th>
                                            <th>VALOR UNITÁRIO</th>
                                            <th>QUANTIDADE</th>
                                            <th>AÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Tb">

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
                            <input required type="text" placeholder="Informe o valor total" onkeyup="formataValor(this)" onblur="validaValor(this)" id="valorTotal" class="form-control input-add" name="valor_total" />
                            <span id="erro_valor_despesa"></span>
                        </div>

                        <div class="px-5 mb-3">
                            <strong>MOEDA</strong>
                            <select readonly class="form-control input-add" name="moeda" id="moeda">
                                <option selected value="REAL">BRL</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>

                    <!-- Rateio -->
                    <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>RATEIO</h3>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                        <div class="flex-column mt-10">
                            <div class="px-5">
                                <span>RATEIO?</span>
                            </div>

                            <div class="d-flex mt-10">
                                <div class="px-5 " style="padding: 8px 12px;">
                                    <strong for="input_rateio form-check-primary">NÃO</strong>
                                    <input class="form-check-input" checked type="radio" onchange="handleChange(this);" name="rateio" value="false">
                                </div>

                                <div class="px-5" style="padding: 8px 12px;">
                                    <strong for="input_rateio">SIM</strong>
                                    <input class="form-check-input" type="radio" onchange="handleChange(this);" name="rateio" value="true">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="div_rateio"></div>
                    <br>
                    <hr>
                    <br>


                    <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>PARCELAS</h3>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                        <div class="flex-column mt-10">
                            <div class="px-5">
                                <span>PARCELAS FIXAS?</span>
                            </div>

                            <div class="d-flex mt-10">
                                <div class="px-5 " style="padding: 8px 12px;">
                                    <strong for="input_parcela form-check-primary">NÃO</strong>
                                    <input class="form-check-input" checked type="radio" name="tipo_parcela" id="tipo_parcela" value="nao">
                                </div>

                                <div class="px-5" style="padding: 8px 12px;">
                                    <strong for="input_parcela_sim">SIM</strong>
                                    <input class="form-check-input" type="radio" name="tipo_parcela" id="tipo_parcela" value="sim">
                                </div>
                            </div>
                        </div>

                        <div>
                            <strong>NUMERO DE PARCELAS</strong>
                            <input required type="text" placeholder="Informe o numero de parcelas" id="numero_parcelas" class="form-control input-add" name="numero_parcelas" />
                        </div>

                        <div>
                            <button class="btn btn-primary" id="adicionar_parcela" type="button" style="padding: 10px 14px;">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <br />
                    <br />

                    <div id="parcelas_geradas">

                    </div>

                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" onclick="atribuiValorAParcelaGerada()" class="btn btn-success me-1 mb-1">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <a href="{{ route('despesas') }}" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
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
                        <input type="text" class="form-control input-add" id="Cnpj_Cpf" autocomplete="off">
                        <div class="input-style" id="ResultadoCnpjCpf" value=""></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btnCnpj_Cpf">
                            SELECIONAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal Rateio-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">RATEIO</h4>

                    <div>
                        <span>VALOR TOTAL: </span>
                        <input class="input-add" id="modal_valor_total" name="modal_valor_total" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px">

                        <span>VALOR RATEADO: </span>
                        <input class="input-add" id="modal_valor_rateado" name="modal_valor_rateado" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple">
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
                            <input class="form-control mt-1" id="valor_rateado" onkeyup="formataValor(this)" type="text" onkeypress="return onlynumber();" placeholder="Valor do item" style="width: 358px" />
                        </div>
                        <div class="d-flex flex-row" style="width: 100%; align-items:center">
                            <div>
                                <input class="form-control mt-1" id="porcentagem_rateado" type="text" min="0" max="5" onkeyup="return validateValue(this);" onkeypress="return onlynumber();" maxlength="3" style="width: 58px" />
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
                            <i data-feather="check-circle"></i>ADICIONAR
                        </button>
                        <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                            CANCELAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Rateio -->



<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/vendors.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<!-- javascript customizado -->
<script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/rateio.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/parcelas.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/valida-cpf-cnpj.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-cnpj-cpf.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-telefone.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/valida-email.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/conta-bancaria-despesa.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/conta-pix.js') }}"></script>

<script>
    function verificaValor(obj) {
        var erro = document.getElementById("erro_valor_item");
        var valor = obj.value.replace(/[^0-9]/g, '');

        if (obj.value != '') {
            if (obj.value.length < 3 || valor <= 0) {
                erro.innerHTML = 'Valor inválido';
                erro.style.color = 'red';
                obj.focus();
            } else {
                erro.innerHTML = '';
            }
        } else {
            erro.innerHTML = '';
        }
    }

    function validaValor(obj) {
        var erro = document.getElementById("erro_valor_despesa");
        var valor = obj.value.replace(/[^0-9]/g, '');

        if (obj.value != '') {
            if (obj.value.length < 3 || valor <= 0) {
                erro.innerHTML = 'Valor inválido';
                erro.style.color = 'red';
                obj.focus();
            } else {
                erro.innerHTML = '';
            }
        } else {
            erro.innerHTML = '';
        }
    }

    function validaqtdItem(obj) {
        var valor = obj.value.replace(/[^0-9]/g, '');

        if (obj.value != '') {
            if (obj.value.length < 3 || valor <= 0) {
                erro.innerHTML = 'Valor inválido';
                erro.style.color = 'red';
                obj.focus();
            } else {
                erro.innerHTML = '';
            }
        } else {
            erro.innerHTML = '';
        }
    }
</script>

@endsection
