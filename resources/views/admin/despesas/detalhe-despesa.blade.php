@extends('layouts.templates.template')
@section('title', 'Despesa')

@section('content')

    <div id="main" style="margin-top: 5px;">
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
                                        <strong>CENTRO DE CUSTO</strong>
                                    </div>
                                    <span>{{ $despesa->de_departamento }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>NUMERO DA DESPESA</strong>
                                    </div>
                                    <span>{{ $despesa->id_despesa }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>TIPO DA DESPESA</strong>
                                    </div>
                                    <span>{{ $despesa->de_tipo_despesa }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>SÉRIE</strong>
                                    </div>
                                    <span>{{ $despesa->serie_despesa }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>DATA DE EMISSÃO</strong>
                                    </div>
                                    <span>{{ $despesa->dt_emissao == null ? '' : date('d/m/Y', strtotime($despesa->dt_emissao)) }}</span>
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
                                        <strong>PARCELAS</strong>
                                    </div>
                                    <span>{{ $despesa->qt_parcelas_despesa }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div>
                                        <strong>VALOR TOTAL</strong>
                                    </div>
                                    <span>{{ $mascara::maskMoeda($despesa->valor_total_despesa) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal"
                            data-bs-target="#xlarge">Editar</button>
                        <a href="{{ route('despesas') }}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inicio Modal Editar-->
        <div class="me-1 mb-1 d-inline-block">
            <!--Extra Large Modal -->
            <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
                aria-hidden="true">
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
                            <form action="/despesas/{{ $despesa->id_despesa }}" method="POST" style="padding: 10px;">
                                @csrf
                                <div class="d-flex mt-10" style="width: 100%">

                                    <div class="px-5 mb-3">
                                        <strong>NUMERO DA NOTA OU DOCUMENTO</strong>
                                        <input type="text" required
                                            onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                            value="{{ $despesa->numero_documento_despesa }}" class="form-control input-add"
                                            name="numero_nota_documento" style="width: 358px" />
                                    </div>

                                    <div class="px-5 mb-3">
                                        <div>
                                            <strong>SERIE</strong>
                                        </div>
                                        <input type="text" required
                                            onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                            value="{{ $despesa->serie_despesa }}" class="form-control input-add"
                                            name="serie_documento" style="width: 358px" />
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="px-5 mb-3">
                                        <strong>TIPO DE DOCUMENTO</strong>
                                        <select class="form-control input-add" required
                                            value="{{ $despesa->tipo_documento }}" name="tipo_documento"
                                            id="tipo_documento" style="width: 358px">
                                            <option value="BOLETO">BOLETO</option>
                                            <option value="DAE">DAE</option>
                                            <option value="DAJE">DAJE</option>
                                            <option value="DARF">DARF</option>
                                            <option value="DARF PREVIDENCIARIO">DARF PREVIDENCIÁRIO</option>
                                            <option value="DARM">DARM</option>
                                            <option value="DASP">DASP</option>
                                            <option value="DEPOSITO">DEPÓSITO</option>
                                            <option value="FATURA">FATURA</option>
                                            <option value="GPS">GPS</option>
                                            <option value="GRERJ">GRERJ</option>
                                            <option value="GRRF">GRRF</option>
                                            <option value="GRU">GRU</option>
                                            <option value="NOTA FISCAL">NOTA FISCAL</option>
                                            <option value="OUTROS">OUTROS</option>
                                            <option value="PIX">PIX</option>
                                            <option value="RECIBO">RECIBO</option>
                                            <option value="TRCT">TRCT</option>
                                        </select>
                                    </div>
                                    <div class="px-5 mb-3">
                                        <strong>DATA DE EMISSÃO</strong>
                                        <input type="date" required
                                            class="form-control input-add" value="{{ $despesa->dt_emissao }}"
                                            id="dt_emissao" name="data_emissao" style="width: 358px" />
                                        <span id="erro_dt_emissao"></span>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" id="btnSalvar" class="btn btn-primary me-1 mb-1">
                                    <i data-feather="check-circle"></i>Salvar
                                </button>
                                <!-- mudar para produto -->
                                <a href="{{ route('despesas') }}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- fim modal -->

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/vendors.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

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

@endsection
