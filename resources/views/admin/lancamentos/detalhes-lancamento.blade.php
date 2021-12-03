@extends('layouts.templates.template')
@section('title', "Detalhes Lançamento")

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Codigo da Despesa : {{$lancamento->id_despesa}}</h1>
                <div class="modal-header">
                    <a href="/despesas/{{$lancamento->id_despesa}}" target="_blank" class="close"> visualiza despesa </a>
                </div>
            </div>
            
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DESCRIÇÃO DA DESPESA</strong>
                                </div>
                                <span>{{$lancamento->de_despesa}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR</strong>
                                </div>
                                <span>{{$lancamento->valor_total_despesa}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO VENCIMENTO</strong>
                                </div>
                                <span>{{$lancamento->dt_vencimento}}</span>
                            </div>
                        </div>
                    </div>


                   


                </div>
                <div class="card-footer">
                    <a href="lancamentos/provisionamento/{{$lancamento->id_despesa}}" class="btn btn-primary" style="padding: 8px 12px;">Pagamento</a>
                    <a href="{{route('lancamentos')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Inicio Modal Adicionar-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Editar Fornecedor</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- mudar para produto  -->
                        <form action="/fornecedores/editar/" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">

                                <div class="px-5 mb-3">
                                    <strong>Razão Social</strong>
                                    <input class="form-control mt-1" type="text" value="" placeholder="Razão Social" name="de_razao_social" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong for="raz_social">Nome Fantasia Social</strong>
                                    </div>
                                    <input class="form-control mt-1" type="text" value="" placeholder="Nome Fantasia" name="de_nome_fantasia" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="px-5 mb-3">
                                    <strong>Inscrição Estadual</strong>
                                    <input class="form-control mt-1" type="text" value="" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>CPF/CNPJ</strong>
                                    <input class="form-control mt-1" type="text" value="" placeholder="CPF/CNPJ" name="nu_cpf_cnpj" style="width: 358px" readonly />
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                <i data-feather="check-circle"></i>Salvar
                            </button>
                            <!-- mudar para produto -->
                            <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                        </div>
                        </form>
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


    @endsection