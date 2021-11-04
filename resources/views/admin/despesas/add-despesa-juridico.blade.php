@extends('layouts.templates.template')
@section('title', 'Despesas com Jurídico')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Nova Despesa com Jurídico</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center " id="list-despesa">
                        <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Coligada</strong>
                                    <select class="form-control input-add" name="coligada" id="coligada">
                                        <option selected value="empresa_1">Empresa 1</option>
                                        <option value="empresa_2">Empresa 2</option>
                                        <option value="empresa_3">Empresa 3</option>
                                        <option value="empresa_4">Empresa 4</option>
                                        <option value="empresa_5">Empresa 5</option>
                                        <option value="empresa_6">Empresa 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>Matriz/Filial</strong>
                                        <select class="form-control input-add" name="matriz_filial" id="matriz_filial">
                                            <option selected value="empresa_1">Empresa 1</option>
                                            <option value="empresa_2">Empresa 2</option>
                                            <option value="empresa_3">Empresa 3</option>
                                            <option value="empresa_4">Empresa 4</option>
                                            <option value="empresa_5">Empresa 5</option>
                                            <option value="empresa_6">Empresa 6</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Situação</strong>
                                    <select class="form-control input-add" name="status" id="status">
                                        <option selected value="pendente">Pendente</option>
                                        <option value="pago">Pago</option>
                                        <option value="aprovado">Aprovado</option>
                                        <option value="rejeitado">Rejeitado</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Conta bancária</strong>
                                    <select class="form-control input-add" name="conta_bancaria" id="conta_bancaria">
                                        <option selected value="conta_bancaria_1">Conta Bancária 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo Despesa</strong>
                                    <input class="form-control input-add" value="Despesas Jurídicas" readonly name="tipo_despesa" id="tipo_despesa" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <select class="form-control input-add" name="descricao" id="descricao">
                                        <option selected value="adiantamento_a_terceiros">Adiantamento a Terceiros</option>
                                        <option value="bloqueio_judicial">Bloqueio Judicial</option>
                                        <option value="cartorio">Cartório</option>
                                        <option value="correspondente_audiencia_diligencia">Correspondente/Audiência/Diligência</option>
                                        <option value="custas">Custas</option>
                                        <option value="depositos_recursais">Depósitos Recursais</option>
                                        <option value="despesas_de_processos_trabalhistas">Despesas de Processos Trabalhistas</option>
                                        <option value="estadia_de_veiculos">Estadia de Veículos</option>
                                        <option value="localizacao">Localização</option>
                                        <option value="notificacoes_protestos">Notificações/Protestos</option>
                                        <option value="publicacoes_juridicas">Publicações Jurídicas</option>
                                        <option value="reembolso_a_efetuar">Reembolso a efetuar</option>
                                        <option value="remocao_estadia">Remoção/Estadia</option>
                                        <option value="remocao_guincho">Remoção/Guincho</option>
                                        <option value="repasse">Repasse</option>
                                        <option value="trabalhista_condenacao">Trabalhista Condenação</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Data De Pagamento</strong>
                                    <input type="date" class="form-control input-add" name="data_pagamento" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Moeda</strong>
                                    <select class="form-control input-add" name="moeda" id="moeda">
                                        <option selected value="real">BRL</option>
                                        <option value="dolar">USD</option>
                                        <option value="euro">EUR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="px-5 mb-3">
                                    <strong>Valor</strong>
                                    <input type="text" placeholder="Valor" class="form-control input-add" name="valor" />
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Adicionar
                                    </button>
                                    <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/js/vendors.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>
@endsection