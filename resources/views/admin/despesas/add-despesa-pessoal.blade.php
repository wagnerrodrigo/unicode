@extends('layouts.templates.template')
@section('title', 'Despesas com Pessoal')

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Nova Despesa com Pessoal</h1>
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
                                    <strong>Funcionário</strong>
                                    <select class="form-control input-add" name="funcionario" id="funcionario">
                                        <option selected value="funcionario_1">Credor 1</option>
                                        <option value="funcionario_2">Funcionário 2</option>
                                        <option value="funcionario_3">Funcionário 3</option>
                                        <option value="funcionario_4">Funcionário 4</option>
                                        <option value="funcionario_5">Funcionário 5</option>
                                        <option value="funcionario_6">Funcionário 6</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Funcionário Endereço</strong>
                                    <select class="form-control input-add" name="funcionario_endereco" id="funcionario_endereco">
                                        <option selected value="funcionario_endereco_1">Endereço 1</option>
                                        <option value="funcionario_endereco_2">Endereço 2</option>
                                    </select>
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
                                    <select class="form-control input-add" name="tipo_despesa" id="tipo_despesa">
                                        <option selected value="reembolso">Reembolso</option>
                                        <option selected value="adiantamento">Adiantamento</option>
                                        <option selected value="salario">Salário</option>

                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Valor</strong>
                                    <input type="text" placeholder="Valor" class="form-control input-add" name="valor" />
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

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
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