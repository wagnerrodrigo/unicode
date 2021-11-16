@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')


<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Despesas</h1>
                <a href="/despesas/adicionar" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nova Despesa
                </a>

            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($despesasAtivas != null || !empty($despesasAtivas))
                        @foreach($despesasAtivas as $despesa)
                        <tr>
                            <td>{{$despesa->id_despesa}}</td>
                            <td>{{$despesa->valor_total_despesa}}</td>
                            <td>{{$despesa->qt_parcelas_despesa}}</td>
                            <td>{{date("d/m/Y", strtotime($despesa->dt_emissao))}}</td>
                            <td>{{$despesa->fk_status_despesa_id}}</td>
                            <td>
                                <form method="GET" action="/despesas/{{$despesa->id_despesa}}" data-bs-toggle="modal" data-bs-target="#xlarge-view" class="btn btn-primary" style="padding: 8px 12px;">
                                    @csrf
                                    <i class="bi bi-eye-fill"></i>
                                </form>
                                <a href="{{route('fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Nenhuma despesa cadastrada</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>




@endsection
