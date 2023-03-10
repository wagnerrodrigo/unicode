@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')
<!-- Inicio Modal Adicionar-->
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>Novo Endereço</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center " id="list-despesa">
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
                                swal({
                                    title: "Atenção",
                                    text: "CEP não encontrado.",
                                    icon: "warning",
                                    button: "Ok",
                                });
                            }
                        }
                    });
                } else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    swal({
                        title: "Atenção",
                        text: "Formato de CEP inválido.",
                        icon: "erro",
                        button: "Ok",
                    });
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
