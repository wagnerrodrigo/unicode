<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>LANÇAMENTOS DISPONIVEIS PARA CONCILIAÇÃO </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('extrato') }}" method="GET">
                    <div class="d-flex">
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" info-data="Data inicio do Pagamento" for="inputDataInicio">DATA INICIO</label>
                                <input class="form-control" type="date" max="" name="dt_inicio" id="inputDataInicio">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3" style="width: 240px">
                                <label class="input-group-text" info-data="Data fim do Pagamento" for="inputDataFim">DATA FIM</label>
                                <input class="form-control" type="date" min="" name="dt_fim" id="inputDataFim">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="btnSearch" class="btn btn-primary" style="padding: 8px 12px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>ID PARCELA</th>
                            <th>DATA DO PAGAMENTO</th>
                            <th>DESCRIÇÃO</th>
                            <th style="padding:1px">VALOR</th>
                            <th style="padding:1px">AGENCIA/CONTA</th>
                            <th>STATUS</th>
                            <th>AÇÕES</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if ($lancamentos != null || !empty($lancamentos))
                        @foreach ($lancamentos as $lancamento)
                        <tr>
                            <td>
                                {{ $lancamento->fk_tab_parcela_despesa_id }}
                                <input type="checkbox" class="inputs_selecionandos" name="inputs_selecionandos[]" value="{{ $lancamento->fk_tab_parcela_despesa_id }}" id="radio_lancamento_{{ $lancamento->id_tab_lancamento }}">
                                <input type="hidden" value="{{ $lancamento->id_tab_lancamento }}" id="id_lancamento_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                            </td>
                            <td id="data_efetivo_pagamento_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                                {{date("d/m/Y", strtotime($lancamento->dt_efetivo_pagamento))}}
                                <input type="hidden" value="{{ $lancamento->dt_efetivo_pagamento }}" id="data_{{ $lancamento->fk_tab_parcela_despesa_id }}">
                            </td>
                            <td>PARCELA {{ $lancamento->num_parcela }}</td>
                            <td style="padding:1px">{{ $mascara::maskMoeda($lancamento->valor_pago) }}<input type="hidden" id="valorDespesa{{$lancamento->fk_tab_parcela_despesa_id}}" value="{{$lancamento->valor_pago}}" /></td>
                            <td>A:{{ $lancamento->nu_agencia }} C:{{$lancamento->nu_conta }}</td>
                            <td>{{ $lancamento->de_status_despesa }}</td>
                            <input type="hidden" id="conta_bancaria_lancamento{{$lancamento->fk_tab_parcela_despesa_id}}" value="{{$lancamento->fk_tab_conta_bancaria}}">
                            <td id="btn_abrir_extratos">
                                <div class="d-flex justify-content-space-between">
                                    <button id="{{ $lancamento->id_tab_lancamento }}" onclick="editLancamento(this.id)" class="btn btn-warning ms-5" style="padding: 8px 12px;"><i class="bi bi-pencil-fill"></i></button>
                                    <!-- <button id="{{ $lancamento->id_tab_lancamento }}" onclick="deleteLancamento(this.id)" class="btn btn-danger ms-2" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button> -->
                                </div>

                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div id="pagination_lancamentos">{{ $lancamentos->links() }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#inputDataFim").attr("disabled", true);
    var inputDataInicio;
    $("#inputDataInicio").on("change", function() {
        inputDataInicio = $(this).val();
        $("#inputDataFim").prop("min", function() {
            return inputDataInicio;
        })
        console.log(inputDataInicio);
        $("#inputDataFim").attr("disabled", false);
        $("#inputDataFim").prop("required", true);
    })
    var inputDataFim;
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
        // $("#btnSearch").attr("disabled", false);
        console.log(inputDataFim);
        console.log($("#inputDataInicio").val());
        $("#inputDataInicio").prop("required", true);
    })
</script>

<script>
    var valorDespesa = 0;
    var lancamentos = [];
    $('input[name="inputs_selecionandos[]"]').change(function() {
        if ($(this).prop("checked") == true) {
            const lancamento = {
                id: $(`#id_lancamento_${$(this).val()}`).val(),
                conta_bancaria: $(`#conta_bancaria_lancamento${$(this).val()}`).val(),
                data: $(`#data_${$(this).val()}`).val(),
            }

            if (lancamentos.length < 1) {
                lancamentos.push(lancamento);
                console.log(lancamentos);
            } else {
                if (lancamento.conta_bancaria != lancamentos[0].conta_bancaria) {
                    swal.fire({
                        title: 'Atenção',
                        text: 'Selecione lancamentos de mesma conta bancaria',
                        type: 'warning',
                        confirmButtonText: 'Fechar'
                    });
                    $(this).prop('checked', false);
                } else {
                    lancamentos.push(lancamento);
                }
            }
            valorDespesa = valorDespesa + Number($(`#valorDespesa${$(this).val()}`).val());
        } else if (lancamentos.length > 0 && extratos.length > 1) {
            swal.fire({
                title: 'Atenção',
                text: 'Selecione apenas um extrato',
                type: 'warning',
                confirmButtonText: 'Fechar'
            });
            $(this).prop('checked', false);
        } else {
            const lancamento = {
                id: $(this).val(),
                conta_bancaria: $(`#conta_bancaria_lancamento${$(this).val()}`).val(),
                data: $(`#data_${$(this).val()}`).val(),
            }

            var lancamentoFiltrado = lancamentos.find(lancamento => lancamento.id === $(this).val());
            lancamentos.splice(lancamentos.indexOf(lancamentoFiltrado), 1);
            valorDespesa = valorDespesa - Number($(`#valorDespesa${$(this).val()}`).val());
        }
    });
</script>
