<div id="" style="margin-top: 5px;" style="width: 50%;">
    <div class="main-content container-fluid">
        <div class="">
            
                <div class="card-header" style="padding: 25px 24px; display: inline-block">
                    <h2>EXTRATOS DISPONIVEIS</h2>
                </div>

                <div class="col-md-2" style="padding: 8px 24px; display: inline-block">
                    <button class="btn btn-primary" id="conciliacao" onclick="conciliacao()" style="padding: 8px 24px; display: inline-block">REALIZAR CONCILIAÇÃO</button>
                </div>

     
            <div class="card-body">
                <table class='table table-striped' id="table2">
                    <thead>
                        <tr>
                            <th>ID EXTRATO</th>
                            <th>DATA PAGAMENTO</th>
                            <th>DESCRIÇÃO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                             <!-- <th>NOME BANCO</th> -->
                            <th>PREÇO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <!-- <th>AGÊNCIA/CONTA</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($extratos as $extrato)
                        <tr class="table table-striped">
                            <td style="padding:6px;">{{$extrato->id_extrato}}<input style="margin-left: 5px;" type="checkbox" name="ids_extratos[]" value="{{$extrato->id_extrato}}" /></td>
                            <td style="padding:6px;">{{date("d/m/Y", strtotime($extrato->dtposted))}}</td>
                            <td style="padding:6px;">{{Str::limit($extrato->memo, 20)}}</td>
                            <!-- <td style="padding:5px;">{{$extrato->org}}</td> -->
                            <td style="padding:6px;">{{$mascara::maskMoeda($extrato->trnamt)}} <input type="hidden" id="valorExtratoId{{$extrato->id_extrato}}" value="{{$extrato->trnamt}}"></td>
                            <!-- <td style="padding:5px;">A:{{$extrato->nu_agencia}} C:{{$extrato->nu_conta}}</td> -->
                            <input type="hidden" id="conta_bancaria_extrato{{$extrato->id_extrato}}" value="{{$extrato->fk_tab_conta_bancaria}}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="pagination_extratos">{{ $extratos->render() }}</div>
            </div>
        </div>
    </div>
</div>

<script>
    var valorExtrato = 0;
    var extratos = [];

    $('input[name="ids_extratos[]"]').change(function() {
        //adiciona extrato ao array de extratos
        if ($(this).prop("checked") == true) {
            const extrato = {
                id: $(this).val(),
                conta_bancaria: $(`#conta_bancaria_extrato${$(this).val()}`).val(),
            }

            if (extrato.conta_bancaria != lancamentos[0].conta_bancaria) {
                swal.fire({
                    title: 'Atenção',
                    text: 'Selecione extratos da mesma conta bancaria dos lançamentos',
                    type: 'warning',
                    confirmButtonText: 'Fechar'
                });
                $(this).prop('checked', false);
            } else {
                if (extratos.length < 1) {
                    extratos.push(extrato);
                } else {
                    if (extrato.conta_bancaria != extratos[0].conta_bancaria) {
                        swal.fire({
                            title: 'Atenção',
                            text: 'Selecione extratos de mesma conta bancaria',
                            type: 'warning',
                            confirmButtonText: 'Fechar'
                        });
                        $(this).prop('checked', false);
                    } else {
                        extratos.push(extrato);
                    }
                }
                valorExtrato = valorExtrato + Number($(`#valorExtratoId${$(this).val()}`).val());
            }
        } else {
            //remove extrato do array
            const extrato = {
                id: $(this).val(),
                conta_bancaria: $(`#conta_bancaria_extrato${$(this).val()}`).val(),
            }

            var extratoFiltrado = extratos.find(extrato => extrato.id === $(this).val());
            extratos.splice(extratos.indexOf(extratoFiltrado), 1);
            valorExtrato = valorExtrato - Number($(`#valorExtratoId${$(this).val()}`).val());
        }
    });
</script>


