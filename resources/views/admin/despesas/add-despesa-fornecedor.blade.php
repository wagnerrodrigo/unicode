@extends('layouts.templates.template')
@section('title', 'Cadastro de Despesas')

@section('content')
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Nova Despesa com Fornecedor</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center " id="list-despesa">
                        <form action="/despesas/adicionar" method="POST" style="padding: 10px;">
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

                    <div class="d-flex mt-10" style="width: 100%">
                        <form action="" name="form_busca_fornecedor" id="form_busca_fornecedor">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <select class="form-control input-add" id="busca_empresa" name="busca_empresa">
                                    <option id="result_empresa"></option>
                                </select>
                            </div>
                        </form>

                        <div class="px-5 mb-3">
                            <strong>CENTRO DE CUSTO</strong>
                            <select class="form-control input-add" name="centro_de_custo" id="centro_de_custo">
                                <option selected value="centro_de_custo_1">Centro de custo 1</option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex mt-10" style="width: 100%">
                        <div class="px-5 mb-3" style="padding: 8px 12px;">
                            <strong for="input_fornecedor form-check-primary">FORNECEDOR</strong>
                            <input class="form-check-input" checked type="radio" name="tipo_despesa" id="despesa_fornecedor" value="fornecedor">
                        </div>

                        <div class="px-5 mb-3" style="padding: 8px 12px;">
                            <strong for="input_empregado">EMPREGADO</strong>
                            <input class="form-check-input" type="radio" name="tipo_despesa" id="despesa_empregado" value="empregado">
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" id="btnDespesa" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#modal-busca">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    <form action="/despesas/adicionar" method="POST">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>CPF/CNPJ</strong>
                                <input type="text" placeholder="CPF/CNPJ" class="form-control input-add" name="cpf_cnpj" readonly />
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Credor</strong>
                                    <select class="form-control input-add" name="credor" id="credor">
                                        <option selected value="credor_1">Credor 1</option>
                                        <option value="credor_2">Credor 2</option>
                                        <option value="credor_3">Credor 3</option>
                                        <option value="credor_4">Credor 4</option>
                                        <option value="credor_5">Credor 5</option>
                                        <option value="credor_6">Credor 6</option>
                                    </select>
                                </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Classificação</strong>
                                <select class="form-control input-add" name="classificacao" id="classificacao">
                                    <option value="despesas_C_pessoal">DESPESAS C/ PESSOAL</option>
                                    <option value="despesas_telefonia">DESPESAS TELEFONIA</option>
                                    <option value="despesas_aluguel">DESPESAS ALUGUEL/COND/ENERGIA/AGUA</option>
                                    <option value="despesas_impostos">DESPESAS IMPOSTOS, TAXAS E CONTRIBUIÇÕES</option>
                                    <option value="despesas_juridica">DESPESAS JURÍDICAS</option>
                                    <option value="despesas_depesas">DESPESAS GERAIS</option>
                                </select>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Número</strong>
                                    <input type="text" placeholder="Informe o numero" class="form-control input-add" name="numero_documento" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Série</strong>
                                    <input type="text" placeholder="Série" class="form-control" name="serie_documento" style="width: 58px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Data Emissão</strong>
                                    <input type="date" class="form-control input-add" name="data_emissao" />
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

                            <div class="d-flex" style="width: 100%;">
                                <div class="px-5 mb-3">
                                    <strong>Quantidade Parcelas</strong>
                                    <input type="text" class="form-control input-add" name="parcelas" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Centro de custo</strong>
                                    <select class="form-control input-add" name="centro_de_custo" id="centro_de_custo">
                                        <option selected value="centro_de_custo_1">Centro de custo 1</option>
                                        <option value="centro_de_custo_2">Centro de custo 2</option>
                                        <option value="centro_de_custo_3">Centro de custo 3</option>
                                        <option value="centro_de_custo_4">Centro de custo 4</option>
                                        <option value="centro_de_custo_5">Centro de custo 5</option>
                                        <option value="centro_de_custo_6">Centro de custo 6</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%;">
                                <div class="px-5 mb-3">
                                    <strong>Rateio</strong>
                                    <select class="form-control input-add" name="rateio" id="rateio">
                                        <option selected value=""></option>
                                        <option value="rateio_por_item">Por item</option>
                                        <option value="rateio_por_despesa">Pela despesa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <h3>Itens</h3>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#xlarge">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%; margin: 15px;">
                                <!-- Inicio da tabela de itens -->
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Produto/serviços</th>
                                                <th>Quantidade</th>
                                                <th>Valor Unitário</th>
                                                <th>Rateio</th>
                                                <th>Remover</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">Monitor</td>
                                                <td>10</td>
                                                <td class="text-bold-500">R$150</td>
                                                <td>CERCRED - SOLUÇÕES DE CONTACT CENTER E RECUPERAÇÃO DE CRÉDITO LTDA</td>
                                                <td>
                                                    <!-- mudar a rota -->
                                                    <a href="#" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fim da tabela de itens -->
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Descrição</strong>
                                    <textarea cols="110" rows="5" class="form-control" name="descricao"></textarea>
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Valor Total</strong>
                                    <input type="text" class="form-control" value="R$100.000,00" name="valor" style="width: 120px" readonly>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Adicionar
                                    </button>
                                    <a href="{{route('despesas')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="me-1 mb-1 d-inline-block">
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Selecionar item</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- muda a rota-->
                    <form action="/despesas/adicionar" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex mt-10" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>produto</strong>
                                <input class="form-control mt-1" type="text" placeholder="produto" name="produto" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <div>
                                    <strong>Valor</strong>
                                </div>
                                <div>
                                    <input class="form-control mt-1" type="text" placeholder="Valor" name="valor_produto" style="width: 358px" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Quantidade</strong>
                                <input class="form-control mt-1" type="text" placeholder="Quantidade" name="quantidade" style="width: 358px" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Selecionar
                        </button>
                        <!-- muda a rota-->
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<script src="{{asset('assets/js/vendors.js')}}"></script>

<script src="{{asset('assets/js/main.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    //Seleciona quais campos irão aparecer na tela
    $(document).ready(function() {
        //instancia jquery do select2 para o input de busca
        $('#busca_empresa').select2();
        //adiciona id do select2 ao input de busca

        $('input:radio[name="seleciona_tela"]').on("change", function() {
            if (this.checked && this.value == '1') {
                $("#campo_razao_social").show();
                $("#input-custom-field4, #input-custom-field5, #input-custom-field6").hide();
            } else {
                $("#input-custom-field4, #input-custom-field5, #input-custom-field6").show();
                $("#campo_razao_social").hide();
            }
        });
    });

    $('.select2-search__field').keyup(function() {

        var text = $(this).val();

        console.log(text);

        if (text != '') {
            $.ajax({
                type: "GET",
                url: `http://localhost:8000/fornecedores/nome/${text}`,
            }).done(function(data) {
                $('#resultado_busca').html(data);

                //var teste = $("#result_empresa").val(data.de_razao_social);
                //console.log(teste);

                //$("#retornoCep").val(dados.cep);
            });
        } else {
            $('#resultado_busca').html('');
        }
        //Aqui dentro você faz o que quer, manda pra um arquivo php com ajax
        //ou sla, vai depender do que você quer fazer
    });

    //seleciona tipo de despesa
    document.getElementById("btnDespesa").onclick = function() {
        var radios = document.getElementsByName("tipo_despesa");
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == "fornecedor") {
                    document.getElementById("titulo-modal").innerHTML = "Adicionar Fornecedor";
                    document.getElementById("tipo-documento").innerHTML = "CNPJ/CPF";
                }
                if (radios[i].value == "empregado") {
                    document.getElementById("titulo-modal").innerHTML = "Adicionar Empregado";
                    document.getElementById("tipo-documento").innerHTML = "CPF";
                }
            }
        }
    };
</script>
@endsection
