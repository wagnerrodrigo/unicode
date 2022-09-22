@extends('layouts.templates.template')
@section('title', 'Despesa')
@section('content')

<input type="hidden" id="valorTotal" value="{{str_replace('.', ',',$despesa->valor_total_despesa)}}" name="valor_total" />
<input type="hidden" id="empresa" value="{{$despesa->fk_tab_centro_custo_id}}" name="empresa" />
<div id="main" style="margin-top: 5px;" onload="validaCentroCusto()">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESA N°{{ $despesa->id_despesa }}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
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
                    @if($despesa->de_status_despesa == 'A PAGAR' ||$despesa->de_status_despesa == 'EM ATRASO')
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
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
                            </div>
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
                    </div>

                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" onclick="submit()" id="btnSalvar" class="btn btn-primary me-1 mb-1">
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
                                CANCELAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Rateio -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="{{ asset('assets/js/custom-js/rateio.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/despesa.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>

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
</script>

<script>
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
