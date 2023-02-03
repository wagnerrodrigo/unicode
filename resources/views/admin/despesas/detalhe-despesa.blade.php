@extends('layouts.templates.template')
@section('title', 'Despesa')
@section('content')


<input type="hidden" id="empresa" value="{{$despesa->fk_tab_centro_custo_id}}" name="empresa" />
<input type="hidden" name="numero_processo" value="">
<div id="main" style="margin-top: 5px;" onload="validaCentroCusto()">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESA N°{{ $despesa->id_despesa }}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body"></div>
                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            @if ($despesa->fk_tab_tipo_despesa_id == $tipo::FORNECEDOR)
                            <div>
                                <strong>EMPRESA</strong>
                            </div>
                            <span>{{ $despesa->de_razao_social }}</span>

                            @elseif($despesa->fk_tab_tipo_despesa_id == $tipo::EMPREGADO)
                            <div>
                                <strong>EMPREGADO</strong>
                            </div>
                            <span>{{ $despesa->nome_empregado }}</span>
                            @else
                            <strong>EMPREGADO/FORNECEDOR</strong>   
                            <span></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>NUMERO DA DESPESA</strong>
                            </div>
                            <span>{{ $despesa->id_despesa }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>EMPRESA</strong>
                            </div>
                            <span>{{ $despesa->de_empresa }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>CENTRO DE CUSTO</strong>
                            </div>
                            <span>{{ $despesa->fk_tab_centro_custo_id == null ? 'NÃO CADASTRADO' : $despesa->de_departamento}}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>STATUS</strong>
                            </div>
                            <span>{{ $despesa->de_status_despesa }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>DATA DE CRIAÇÃO</strong>
                            </div>
                            <span>{{ $despesa->dt_inicio == null ? 'NÃO CADASTRADO' : date('d/m/Y', strtotime($despesa->dt_inicio)) }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>CLASSIFICAÇÃO</strong>
                            </div>
                            <span>{{ $despesa->de_clasificacao_contabil }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>TIPO</strong>
                            </div>
                            <span>{{ $despesa->de_plano_contas }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>PARCELAS</strong>
                            </div>
                            <span>{{$despesa->qt_parcelas_despesa}}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>VALOR TOTAL</strong>
                            </div>
                            <span>{{ $mascara::maskMoeda($despesa->valor_total_despesa) }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>PARCELAS EM ABERTO</strong>
                            </div>
                            <span>

                                @foreach($quantidadeReparcela as $quantidadeReparcela)
                                @endforeach

                                @foreach($quantidade as $quantidade)
                                @endforeach

                                @if($quantidadeReparcela->num_reparcela != 0)
                                {{$quantidadeReparcela->num_reparcela}}

                                @else

                                {{$quantidade->num_parcela}}


                                @endif

                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div>
                                <strong>VALOR TOTAL EM ABERTO</strong>
                            </div>
                            <span>
                                @foreach($parcelas as $parcelas)
                                {{$mascara::maskMoeda($parcelas->valor_parcela)}}
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>



                @if(count($rateios) > 0)
                <div class="card-header">
                    <h1>Rateio</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th style="padding:10px;">ID</th>
                            <th>Empresa</th>
                            <th>Centro de custo</th>
                            <th>Valor</th>
                            <th style="padding:5px;">%</th>
                        </thead>

                        <tbody>
                            @foreach($rateios as $rateio)
                            <tr>
                                <td style="padding:5px;">{{$rateio->id_rateio_despesa}}</td>
                                <td>{{$rateio->de_empresa}} {{$rateio->regiao_empresa}}</td>
                                <td>{{$rateio->de_departamento}}</td>
                                <td>{{$mascara::maskMoeda($rateio->valor_rateio_despesa)}}</td>
                                <td style="padding:5px;">{{$rateio->porcentagem_rateio_despesa}}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                </hr>
            </div>

            <div class="card-footer">

                @if($despesa->de_status_despesa == 'A PAGAR' ||$despesa->de_status_despesa == 'EM ATRASO'||$despesa->de_status_despesa == 'REPARCELADO')
                <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>

                @if($despesa->reparcelado != 'Sim')
                <button class="btn btn-primary" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge1">Reparcelar</button>
                @endif


                @endif

                <a href="{{ route('despesas') }}" class="btn btn-danger" style="padding: 8px 12px;">Voltar</a>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal Editar-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Editar despesa</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- mudar para produto  -->
                    <form action="/despesas/{{ $despesa->id_despesa }}" method="POST" style="padding: 10px;" id="form_edit_despesa">
                        @csrf
                        <div id="hidden_inputs"></div>
                        <input type="hidden" name="valor_total" value="{{$despesa->valor_total_despesa}}">
                        <input type="hidden" name="id_empresa_selecionada" id="id_busca_empresa" value="{{$despesa->fk_empresa_id}}" />
                        <div id="hidden_inputs_parcelas"></div>

                        <div class="px-1 mb-1">
                            <strong>TITULO</strong>
                            <input required id="titulo" value="{{ $despesa->de_despesa }}" name="titulo_despesa" maxlength="100" class="form-control input-busca"></input>
                        </div>
                        <br>
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>CENTRO DE CUSTO</strong>
                                <select class="form-control input-add" id="inputCentroCusto" onchange="validaCentroCusto()" name="centro_custo" style="width: 358px">
                                    <option value=""></option>
                                    @foreach($costCenter as $costC)
                                    @if($costC->id_centro_custo == $despesa->fk_tab_centro_custo_id)
                                    <option selected value="{{$costC->id_centro_custo}}">{{$costC->de_departamento}}</option>
                                    @else
                                    <option value="{{$costC->id_centro_custo}}">{{$costC->de_departamento}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="px-1 mb-1">
                                <strong>EMPRESA</strong>
                                <input required type="text" style="width:500px;" id="busca_empresa" value="{{$despesa->de_empresa}}" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" />
                                <div id="results_empresa" class="resultado-busca"></div>
                            </div>
                        </div>

                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-1">
                                <strong>CLASSIFICAÇÃO</strong>
                                <input required class="form-control input-add" value="" name="classificacao" id="classificacao_con" readonly style="cursor: pointer;"></input>
                                <div id="itens_classificacao" class="input-style" style="cursor: pointer;"></div>
                            </div>

                            <div class="px-1 mb-1">
                                <strong>TIPO</strong>
                                <select required class="form-control input-add" name="tipo_classificacao" id="tipo_classificacao" style="cursor: pointer;">
                                </select>
                            </div>

                        </div>




                        <hr>
                    </form>
                    @if(count($rateios) == 0)
                    <div class="d-flex flex-column" id="div_rateio_gerado" style="width: 100%;">
                        <div class="px-5" style="padding: 8px 12px;">
                            @if($despesa->fk_tab_centro_custo_id)
                            <button class="btn btn-primary" id="adicionar_rateio" onclick="pegaValorDespesa();" type="button" data-bs-toggle="modal" data-bs-target="#xrateio" style="padding: 8px 12px;"><i class="bi bi-plus"></i></button>
                            @else
                            <button class="btn btn-primary" id="adicionar_rateio" disabled onclick="pegaValorDespesa();" type="button" data-bs-toggle="modal" data-bs-target="#xrateio" style="padding: 8px 12px;"><i class="bi bi-plus"></i></button>
                            @endif
                        </div>
                        <div class="px-5 mb-3">
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
                    </div>

                    @endif


                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" onclick="submit()" id="btnSalvar" class="btn btn-primary me-1 mb-1 btn btn-success me-1 mb-1">
                                <i data-feather="check-circle"></i>Salvar
                            </button>
                            <!-- mudar para produto -->
                            <a href="" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Inicio Modal Rateio-->
<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true" style="background-color: black;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">RATEIO</h4>

                    <div>
                        <span>VALOR TOTAL: </span>
                        <input class="input-add" id="modal_valor_total" value="" name="modal_valor_total" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px">

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
                            VOLTAR
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- Fim modal Rateio -->


<!-- Model Reparcelar -->
<div class="me-1 mb-1 d-inline-block">
    <div class="modal fade text-left w-100" id="xlarge1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Reparcelar</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="/despesas/reparcelar/{{$despesa->id_despesa}}" method="POST" id="form_reparcela">
                        @csrf

                        <div id="hidden_inputs"></div>
                        <input type="hidden" name="valor_total" value="{{$despesa->valor_total_despesa}}">
                        <input type="hidden" name="id_despesa" value="{{$despesa->id_despesa}}">
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">

                                <div class="px-5 mb-3">
                                    <strong>VALOR</strong>
                                    <input required disabled type="text" value="{{$mascara::maskMoeda($parcelas->valor_parcela)}}" placeholder="Informe o valor total" onkeyup="formataValor(this)" onblur="validaValor(this)" id="valorTotal" class="form-control input-add" name="valor_total" />
                                </div>

                                <br>
                                <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                                    <div class="flex-column mt-10">
                                        <div class="px-5">
                                            <span>
                                                <h3>PARCELAS FIXAS?</h3>
                                            </span>
                                        </div>

                                        <div class="d-flex mt-10">
                                            <div class="px-5 " style="padding: 8px 12px;">
                                                <strong for="input_parcela form-check-primary">NÃO</strong>
                                                <input class="form-check-input" checked type="radio" name="tipo_parcela" id="parcela_variavel" value="nao">
                                            </div>

                                            <div class="px-5" style="padding: 8px 12px;">
                                                <strong for="input_parcela_sim">SIM</strong>
                                                <input class="form-check-input" type="radio" name="tipo_parcela" id="parcela_fixa" value="sim">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <strong>NUMERO DE PARCELAS</strong>
                                        <input required type="text" value="{{$quantidade->num_parcela}}" placeholder="Informe o numero de parcelas" id="numero_parcelas" class="form-control input-add" name="numero_parcelas" />
                                    </div>

                                    <div>
                                        <button class="btn btn-primary" id="adicionar_parcela" type="button" style="padding: 10px 14px;">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <br />
                                <br />

                                <div id="parcelas_geradas" class="flex-column">
                                </div>

                                <div class="modal-footer">
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="button" onclick="atribuiValorAReparcelaGerada()" class="btn btn-success me-1 mb-1">
                                            <i data-feather="check-circle"></i>ADICIONAR
                                        </button>
                                        <a href="" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
                                    </div>
                                </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Model Reparcelar -->
</div>

<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<!-- javascript customizado -->
<script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/rateio.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/parcelas.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/reparcelas.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/valida-cpf-cnpj.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-cnpj-cpf.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-telefone.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/valida-email.js') }}"></script>

<script>
    $("#dt_emissao").on("change", function() {
        var dateObj = $("#dt_emissao").val();

        var dataDividida = dateObj.split("-");
        var data = new Date(dataDividida[0], dataDividida[1] - 1, dataDividida[2]);
        var now = new Date();
        var dataAtual = new Date(now.getFullYear(), now.getMonth(), now.getDate());

        if (data > dataAtual) {
            $(this).css({
                color: "red"
            });
            $("#erro_dt_emissao")
                .html("Data de emissão maior que a data atual")
                .css({
                    color: "red",
                    fontStyle: "italic"
                });
            $("#btnSalvar").attr("disabled", true);
            $("#dt_emissao").focus();
        } else {
            $("#erro_dt_emissao").html("");
            $(this).css({
                color: "black"
            });
            $("#btnSalvar").attr("disabled", false);
        }
    });

    var valor = document.getElementById("tipo_documento").value;
    window.onload = removeOption(valor);

    function removeOption(value) {
        var select = document.getElementById("tipo_documento");

        var i = select.options.length;
        while (i--) {
            if (select.options[i].value == value) {
                if (document.getElementById('tipo_documento').options[i].getAttribute('selected') == null) {
                    select.remove(i);
                }
            }
        }
    }

    function validaCentroCusto() {
        var inputCentroCusto = document.getElementById("inputCentroCusto").value;

        if (inputCentroCusto == '' || inputCentroCusto == null) {
            $("#adicionar_rateio").attr("disabled", true);
        } else {
            $("#adicionar_rateio").attr("disabled", false);
            centro_de_custo_selecionado = inputCentroCusto;
        }
    }

    function submit() {
        var form_edit_despesa = document.getElementById("form_edit_despesa");
        form_edit_despesa.submit();
    }
</script>


@endsection