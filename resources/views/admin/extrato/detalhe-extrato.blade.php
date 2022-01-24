@extends('layouts.templates.template')
@section('title', 'Extrato')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Extrato N° </h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">

                    <form action="" method="post">
                        @csrf
                        <div class="container px-2">
                            <div class="row">
                                <div class="col">
                                    <h3>DESPESA</h3>
                                    <div class="p-3 ">
                                        <div class="col-6" style="width: 100%">
                                            <div class="d-flex">
                                                <table class=" table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>TITULO</th>
                                                            <th>EMPRESA</th>
                                                            <th>CNPJ</th>
                                                            <th>CENTRO CUSTO</th>
                                                            <th>VALOR TOTAL DESPESA</th>
                                                            <th>DATA DO VENCIMENTO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @if(!empty($lancamentos))
                                                            @foreach($lancamentos as $lancamento)
                                                            <td>{{$lancamento->de_despesa}}</td>
                                                            <td>{{$lancamento->de_empresa}}</td>
                                                            <td>{{$lancamento->cnpj_empresa}}</td>
                                                            <td>{{$mascara::mask($lancamento->cnpj_empresa, '##.###.###/####-##')}}</td>
                                                            <td>{{$lancamento->fk_tab_centro_custo_id}}</td>
                                                            <td>{{$mascara::maskMoeda($lancamento->valor_total_despesa)}}</td>
                                                            <td>{{$lancamento->dt_vencimento}}</td>
                                                            @endforeach
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col">
                                <h3>EXTRATO</h3>
                                <div class="p-3 ">
                                    <div class="col-6" style="width: 100%">
                                        <div class="d-flex">
                                            <table class=" table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>EMPRESA</th>
                                                        <th>BANCO </th>
                                                        <th>CONTA</th>
                                                        <th>DATA DO PAGAMENTO</th>
                                                        <th>VALOR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>CODE AND GO DESENVOLVIMENTO DE SISTEMAS LTDA - BELO HORIZONTE </td>
                                                        <td>BANCO DA AMAZNIA S.A. </td>
                                                        <td>111111111</td>
                                                        <td>05/12/2021</td>
                                                        <td>100</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Salva</button>
                    <a href="{{ route('extrato') }}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio Modal CONFIRMAÇÃO-->
<div class="modal-danger me-1 mb-1 d-inline-block">
    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel120">CONCILIAÇÃO</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente cadastra a CONCILIAÇÃO ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancelar</span>
                    </button>
                    <form action="" method="POST">
                        @csrf
                        <button class="btn btn-success ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cadastra</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal CONFIRMAÇÃO-->

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

@endsection
