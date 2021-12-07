@extends('layouts.templates.template')
@section('title', 'Detalhes Lançamento')

@section('content')

    <div id="main" style="margin-top: 5px;">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-header">
                    <h1>Codigo da Despesa : {{ $lancamento->id_despesa }}</h1>
                    <div class="modal-header">
                        <a href="/despesas/{{ $lancamento->id_despesa }}" target="_blank" class="close"> visualiza
                            despesa </a>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="card-body" style="font-size: 18px;">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div>
                                            <strong>DESCRIÇÃO DA DESPESA</strong>
                                        </div>
                                        <span>{{ $lancamento->de_despesa }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>VALOR</strong>
                                        </div>
                                        <span>{{ $lancamento->valor_total_despesa }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div>
                                            <strong>DATA DO VENCIMENTO</strong>
                                        </div>
                                        <span>{{ date( 'd/m/Y' , strtotime( $lancamento->dt_vencimento ) ) }}</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlarge"
                                style="padding: 8px 12px;">Pagamento
                            </button>
                            <a href="{{ route('lancamentos') }}" class="btn btn-danger"
                                style="padding: 8px 12px;">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

  

     <!-- Inicio Modal CONFIRMAÇÃO-->
     <div class="modal-danger me-1 mb-1 d-inline-block">
        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title white" id="myModalLabel120">PAGAMMENTO</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deseja realmente cadastra o Pagamento ?
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
