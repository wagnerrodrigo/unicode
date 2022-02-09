@extends('layouts.templates.template')
@section('title', 'Lista Despesas')
@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESAS</h1>
                <a href="/despesas/adicionar" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> NOVA DESPESA
                </a>
            </div>
            <div class="card-body">
                <!-- Form de filtro por status -->
                <form name="form_status">
                    <div class="d-flex flex-row justify-content-around">
                        <div>
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">RESULTADOS</label>
                                <select class="form-select" id="inputStatus" name="results">
                                    <option name="results" selected value="10">10</option>
                                    <option name="results" value="15">15</option>
                                    <option name="results" value="20">20</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">STATUS</label>
                                <select class="form-select" id="inputStatus" name="status">
                                    <option selected value=""></option>
                                    <option value="6">A PAGAR</option>
                                    <option value="3">CANCELADO</option>
                                    <option value="4">EM ATRASO</option>
                                    <option value="5">MIGRAÇÃO</option>
                                    <option value="2">PAGO</option>
                                    <option value="1">PROVISIONADO</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3" style="width: 350px">
                                <label class="input-group-text" for="inputStatus">FILTRO</label>
                                <select class="form-select" id="inputBusca" name="chave_busca">
                                    <option selected value=""></option>
                                    <option value="id_despesa">NÚMERO</option>
                                    <option value="dt_vencimento">VENCIMENTO</option>
                                </select>
                                <input type="text" class="busca_despesa" id="valor_busca" name="valor_busca">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 12px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>NÚMERO</th>
                            <th>VALOR</th>
                            <th>PARCELAS</th>
                            <th>VENCIMENTO</th>
                            <th>STATUS</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($despesas) > 0)
                        @foreach($despesas as $despesa)
                        <tr class={{$despesa->de_status_despesa != 'EM ATRASO' ? "font-color-despesa" : "font-color-despesa-vencida"}}>
                            <td>{{$despesa->id_despesa}}</td>
                            <td>{{$mascara::maskMoeda($despesa->valor_total_despesa)}}</td>
                            <td>{{$despesa->qt_parcelas_despesa}}</td>
                            <td>{{$despesa->dt_vencimento != null ? date("d/m/Y", strtotime($despesa->dt_vencimento)) : ''}}</td>
                            <td>{{$despesa->de_status_despesa}}</td>
                            <td>
                                <a href="/despesas/{{$despesa->id_despesa}}" class="btn btn-primary" style="padding: 8px 12px;">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                <button data-bs-toggle="modal" data-bs-target="#delete{{$despesa->id_despesa}}" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Inicio Modal Delete-->
                        <div class="modal-danger me-1 mb-1 d-inline-block">
                            <!--Danger theme Modal -->
                            <div class="modal fade text-left" id="delete{{$despesa->id_despesa}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Deseja realmente excluir a Despesa: {{$despesa->id_despesa}}?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancelar</span>
                                            </button>
                                            <form action="/despesas/delete/{{$despesa->id_despesa}}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Excluir</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fim Modal Delete-->
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">DESPESA NÃO CADASTRADA</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
                <div>{{ $despesas->links() }}</div>
            </div>

        </div>
    </div>
</div>

<!-- <script src="assets/js/feather-icons/feather.min.js"></script> -->
<!-- <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script> -->

<!-- <script src="assets/vendors/simple-datatables/simple-datatables.js"></script> -->
<!-- <script src="assets/js/vendors.js"></script> -->

<script src="assets/js/main.js"></script>

<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script>
    $("#inputBusca").on("change", function() {
        if ($(this).val() == "id_depesa") {
            $("#valor_busca").attr("type", "text");
        } else if ($(this).val() == "dt_vencimento") {
            $("#valor_busca").attr("type", "date");
        }
    });
</script>


@endsection
