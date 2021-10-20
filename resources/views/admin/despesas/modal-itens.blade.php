@extends('layouts.templates.template-login')


<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel16">Novo Itens</h4>
            <!-- pergunta ao pedro se é a melhor solução -->
            <a href="{{route('despesas')}}" class="btn btn- close"  data-bs-dismiss="modal" aria-label="Close">
                <i class="bi bi-x" data-feather="x"></i>
            </a>
        </div>
        <div class="modal-body">
            <!-- mudar a rota -->
            <form action="{{route('despesas')}}" method="POST" style="padding: 10px;">
                @csrf
                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Produto/serviços</strong>
                        <select class="form-control" name="produto" id="produto" style="width: 358px">
                            <option selected value="produto_1">Produto 1</option>
                            <option value="produto_2">Produto 2</option>
                            <option value="produto_3">Produto 3</option>
                        </select>
                    </div>

                    <div class="px-5 mb-3">
                        <strong>Classificação Contábil</strong>
                        <select class="form-control" name="class_contabil" id="class_contabil" style="width: 358px">
                            <option selected value="class_1">Classificação 1</option>
                            <option value="class_2">Classificação 2</option>
                            <option value="class_3">Classificação 3</option>
                        </select>
                    </div>
                </div>


                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Quantidade</strong>
                        <input type="text" class="form-control" name="quantidade" style="width: 358px" />
                    </div>

                    <div class="px-5 mb-3">
                        <strong>Valor Unitário</strong>
                        <input type="text" class="form-control" name="valor_unitario" style="width: 358px">
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Centro de custos</strong>
                        <select class="form-control" name="centro_custo" id="centro_custo" style="width: 358px">
                            <option selected value="centro_custo_1">Centro Custo 1</option>
                            <option value="centro_custo_2">Centro Custo 2</option>
                            <option value="centro_custo_3">Centro Custo 3</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex" style="width: 100%">
                    <div class="px-5 mb-3">
                        <strong>Descrição</strong>
                        <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
                    </div>
                </div>


                <div class="modal-footer">
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





<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>