<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="d-flex justify-content-between">
                <div class="card-header">
                    <h1>EXTRATOS DISPONIVEIS</h1>
                </div>
                <div class="px-5 mt-4">
                    <button class="btn btn-primary" id="conciliacao" onclick="conciliacao()">REALIZAR CONCILIAÇÃO</button>
                </div>
            </div>

            <div class="card-body">
                <table class='table table-striped' id="table2">
                    <thead>
                        <tr>
                            <th>ID EXTRATO</th>
                            <th>DATA PAGAMENTO</th>
                            <th>DESCRIÇÃO</th>
                            <th>NOME BANCO</th>
                            <th>PREÇO</th>
                            <th>AGÊNCIA/CONTA</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($extratos as $extrato)
                        <tr class="table table-striped">
                            <td style="padding:5px;">{{$extrato->id_extrato}}<input style="margin-left: 5px;" type="checkbox" name="ids_extratos[]" value="{{$extrato->id_extrato}}" /></td>
                            <td style="padding:5px;">{{date("d/m/Y", strtotime($extrato->dtposted))}}</td>
                            <td style="padding:5px;">{{$extrato->memo}}</td>
                            <td style="padding:5px;">{{$extrato->org}}</td>
                            <td style="padding:5px;">{{$extrato->trnamt}} <input type="hidden" id="valorExtratoId{{$extrato->id_extrato}}" value="{{$extrato->trnamt}}"></td>
                            <td style="padding:5px;">A:{{$extrato->nu_agencia}} C:{{$extrato->nu_conta}}</td>
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
