@extends('layouts.templates.template')
@section('title', "Detalhes Lançamento")

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Efetivo Pagamento </h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong for="raz_social">NÚMERO DA DESPESA </strong>
                                </div>
                                <span>teste</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DESCRIÇÃO DA DESPESA</strong>
                                </div>
                                <span>teste</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>VALOR</strong>
                                </div>
                                <span>teste</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO VENCIMENTO</strong>
                                </div>
                                <span>teste</span>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>INSTITUIÇÕES BANCÁRIAS</strong>
                                </div>
                               <input type="text" name="inst_banco" id="inst_banco" class="form-control input-add">
                               <div class="Resultado_inst_banco input-add" id="Resultado_inst_banco"></div>
                                <!--serve somente para armazenar o id da instituição bancária selecionada-->
                                <input type="hidden" id="id_inst_banco"></input>
                                <!-- ### -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>AGÊNCIA</strong>
                                </div>
                               <select type="text" name="agencia" id="agencia" class="form-control input-add">
                                    <option selected value="" class="Resultado_agencia"></option>
                               </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CONTAS BANCARIAS</strong>
                                </div>
                               <select type="text" name="conta_banco" id="conta_banco" class="form-control input-add">
                                   <option selected value="" class="Resultado_conta_banco"></option>
                               </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO EFETIVO PAGAMENTO</strong>
                                </div>
                               <input type="date" name="" id="" class="form-control input-add">
                            </div>
                        </div>
                    </div>
                    

                    <div class="card-header">
                        <h2>FORNECEDOR  / EMPREGADO </h2>
                    </div>


                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>INSTITUIÇÕES BANCÁRIAS </strong>
                                </div>
                               <input type="text" name="inst_banco_forne_empr" id="inst_banco_forne_empr" class="form-control input-add">
                               <div class="Resultado_inst_banco_forn_empr input-add" id="Resultado_inst_banco_forn_empr"></div>
                                 <!--serve somente para armazenar o id da instituição bancária selecionada-->
                                 <input type="hidden" id="id_inst_banco_forn_empr"></input>
                                 <!-- ### -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>AGÊNCIA</strong>
                                </div>
                               <select type="text" name="agencia_forne_empr" id="agencia_forne_empr" class="form-control input-add">
                                    <option selected value="" class="Resultado_agencia_forne_empr"></option>
                               </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CONTAS BANCARIAS</strong>
                                </div>
                               <select type="text" name="conta_banco_forne_empr" id="conta_banco_forne_empr" class="form-control input-add">
                                <option selected value="" class="Resultado_conta_banco_forne_empr"></option>
                               </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>DATA DO EFETIVO PAGAMENTO</strong>
                                </div>
                               <input type="date" name="" id="" class="form-control input-add">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">

                    <button href="" class="btn btn-primary" style="padding: 8px 12px;">Cadastra Pagamento</button>
                    <a href="{{route('pagamentos')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

  
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/custom-js/pagamento.js') }}"></script>

    @endsection