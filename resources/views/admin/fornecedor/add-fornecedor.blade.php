@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')
<!-- Inicio Modal Adicionar-->
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Novo Fornecedor</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center " id="list-despesa">
                        <form action="{{route('fornecedores')}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex mt-10" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Nome Fantasia</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Nome" name="nome_fantasia" style="width: 358px" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>Razão Social</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Razão Social" name="razao_social" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Inscrição Estadual</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>CPF/CNPJ</strong>
                                        <input class="form-control mt-1" type="text" placeholder="CPF/CNPJ" name="cnpj" style="width: 358px" />
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Tipo Pessoa</strong>
                                    <select class="form-control" name="tipo_pessoa" id="tipo_pessoa" style="width: 358px">
                                        <option selected value="fisica">Fisica</option>
                                        <option value="juridica">Jurídica</option>
                                    </select>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Telefone</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Telefone" name="telefone" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Email</strong>
                                    <input class="form-control mt-1" type="email" placeholder="E-mail" name="email" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Email Secundário(Opcional)</strong>
                                    <input class="form-control mt-1" type="email" placeholder="E-mail" name="email_secundario" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Ponto Contato</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Ponto contato" name="ponto_contato" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>Cargo Função</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Cargo Função" name="cargo_funcao" style="width: 358px" />
                                </div>

                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Ramo Atuação</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Ramo atuação" name="ramo_atuacao" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <h3>Endereços</h3>
                                    <button class="btn btn-primary" type="button" id="button_endereco" data-bs-toggle="modal" data-bs-target="#xlarge">
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
                                                <th>Cep</th>
                                                <th>Logradouro</th>
                                                <th>Número</th>
                                                <th>Complemento</th>
                                                <th>Bairro</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold-500">36010-000</td>
                                                <td>Rua Halfeld</td>
                                                <td>100</td>
                                                <td class="text-bold-500">de 101/102 a 449/450</td>
                                                <td>Centro</td>
                                                <td>Juiz de Fora</td>
                                                <td>MG</td>
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
                            <div class="modal-footer">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                        <i data-feather="check-circle"></i>Adicionar
                                    </button>
                                    <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                                </div>
                        </form>
                    </div>
                </div>
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
                    <h4 class="modal-title" id="myModalLabel16">Novo Endereço</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x" data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Inicio formulario para envio de cep para api -->
                    <div class="d-flex mt-10" style="width: 100%">
                        <form action="#" method="POST" id="formCep" style="padding: 10px;">
                            @csrf
                            <div class="px-5 mb-3">
                                <strong>Cep</strong>
                                <input class="form-control mt-1" type="text" id="cep" placeholder="Cep" name="cep" style="width: 358px" />
                            </div>
                        </form>
                    </div>
                    <!--Fim formulario para envio de cep para api -->

                    <form action="/enderecos" method="POST" style="padding: 10px;">
                        @csrf
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Logradouro</strong>
                                <input class="form-control mt-1" type="text" id="logradouro" placeholder="Logradouro" name="logradouro" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Número</strong>
                                <input class="form-control mt-1" type="text" placeholder="Número" name="numero" style="width: 358px" />
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Complemento(opcional)</strong>
                                <input class="form-control mt-1" id="complemento" type="text" placeholder="Complemento" name="complemento" style="width: 358px" />
                            </div>

                            <div class="px-5 mb-3">
                                <strong>Bairro</strong>
                                <input class="form-control mt-1" id="bairro" type="text" placeholder="Bairro" name="bairro" style="width: 358px" />
                            </div>

                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>Cidade</strong>
                                <input class="form-control mt-1" id="localidade" type="text" placeholder="Cidade" name="cidade" style="width: 358px" />
                            </div>
                            <div class="px-5 mb-3">
                                <strong>Estado</strong>
                                <input class="form-control mt-1" id="uf" type="text" placeholder="Estado" name="estado" style="width: 358px" />
                            </div>

                            <div>
                                <input type="hidden" id="retornoCep" name="retornoCep" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>Adicionar
                        </button>
                        <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $("#button_endereco").click(function() {
            // Limpa valores do formulário de cep.
            $("#cep").val("");
            $("#retornoCep").val("");
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#localidade").val("");
            $("#uf").val("");
        });

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#retornoCep").val("...");
                    $("#logradouro").val("...");
                    $("#complemento").val("...");
                    $("#bairro").val("...");
                    $("#localidade").val("...");
                    $("#uf").val("...");

                    //Consulta o webservice viacep.com.br/

                    $.ajax({
                        url: '/cep',
                        type: 'POST',
                        data: {
                            cep: cep,
                            _token: $('input[name=_token]').val()
                        },
                        success: function(data) {
                            if (!("erro" in data)) {

                                var dados = JSON.parse(data.scalar);

                                $("#retornoCep").val(dados.cep);
                                $("#logradouro").val(dados.logradouro);
                                $("#complemento").val(dados.complemento);
                                $("#bairro").val(dados.bairro);
                                $("#localidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        }
                    });
                } else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
</script>

@endsection