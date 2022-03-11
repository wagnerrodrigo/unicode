@extends('layouts.templates.template')
@section('title', "Fornecedor")

@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>{{$fornecedor->de_nome_fantasia}}</h1>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong for="raz_social">Razão Social</strong>
                                </div>
                                <span>{{$fornecedor->de_razao_social}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>CPF/CNPJ</strong>
                                </div>
                                <span>{{strlen($fornecedor->nu_cpf_cnpj) == 14
                                ? $mascara::mask($fornecedor->nu_cpf_cnpj, '##.###.###/####-##')
                                : $mascara::mask($fornecedor->nu_cpf_cnpj, '###.###.###-##')}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Inscrição estadual</strong>
                                </div>
                                <span>{{$fornecedor->inscricao_estadual}}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <strong>Nome Fantasia</strong>
                                </div>
                                <span>{{$fornecedor->de_nome_fantasia}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" style="padding: 8px 12px;" data-bs-toggle="modal" data-bs-target="#xlarge">Editar</button>
                    <a href="{{route('fornecedores')}}" class="btn btn-danger" style="padding: 8px 12px;">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <!--- Endereços -->

    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>ENDEREÇOS</h1>
                <div style="padding: 8.5px 0 0 22.5px; margin-top: 3px">
                    <button class="btn btn-primary" style="width: 2.5rem; padding: 6.5px; margin-top: 3px" data-bs-toggle="modal" data-bs-target="#xlarge_adress"><i class="bi bi-plus"></i></button>
                </div>
            </div>
            <div class="card-body" style="font-size: 18px;">
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        @if($adresses == null)
                        <tr>
                            <td>Não existem endereços cadastrados</td>
                        </tr>
                        @else
                        <thead>
                            <tr>
                                <th>LOGRADOURO</th>
                                <th>BAIRRO</th>
                                <th>CIDADE/ESTADO</th>
                                <th>CEP</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($adresses as $adress)
                            <tr>
                                <td>{{strtoupper($adress->logradouro)}} - {{$adress->numero}}</td>
                                <td>{{strtoupper($adress->bairro)}}</td>
                                <td>{{strtoupper($adress->no_cidade)}} - {{strtoupper($adress->sg_uf)}}</td>
                                <td>{{$mascara::mask($adress->cep, '#####-###')}}</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#xlarge_adress_{{$adress->id_endereco}}" class="btn btn-primary" style="padding: 8px 12px; margin-right:3px;">
                                        <i class="bi bi-pen-fill"></i>
                                    </button>
                                    <button id="endereco_{{$adress->id_endereco}}" onclick="deleteAdress(this.id)" class="btn btn-danger" style="padding: 8px 12px;">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Inicio Modal Editar Endereços -->
                            <div class="me-1 mb-1 d-inline-block">
                                <div class="modal fade text-left w-100" id="xlarge_adress_{{$adress->id_endereco}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel16">EDITAR ENDEREÇO</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x" data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/enderecos/edit/{{$adress->id_endereco}}" name="editFormEndereco_{{$adress->id_endereco}}" method="POST" style="padding: 10px;">
                                                    @csrf
                                                    <div class="d-flex" style="width: 100%">
                                                        <div class="px-5 mb-3">
                                                            <strong>CEP</strong>
                                                            <input class="form-control mt-1" type="text" readonly placeholder="Cep" name="cep" value="{{$adress->cep}}" style="width: 358px" />
                                                        </div>
                                                    </div>
                                                    <div class="d-flex" style="width: 100%">
                                                        <div class="px-5 mb-3">
                                                            <strong>LOGRADOURO</strong>
                                                            <input class="form-control mt-1" type="text" readonly placeholder="Logradouro" name="logradouro" value="{{$adress->logradouro}}" style="width: 358px" />
                                                        </div>
                                                        <div class="px-5 mb-3">
                                                            <strong>NÚMERO</strong>
                                                            <input class="form-control mt-1" type="text" placeholder="Número" name="numero" value="{{$adress->numero}}" style="width: 358px" />
                                                        </div>
                                                    </div>

                                                    <div class="d-flex" style="width: 100%">
                                                        <div class="px-5 mb-3">
                                                            <strong>COMPLEMENTO(OPCIONAL)</strong>
                                                            <input class="form-control mt-1" type="text" placeholder="Complemento" name="complemento" value="{{$adress->complemento}}" style="width: 358px" />
                                                        </div>

                                                        <div class="px-5 mb-3">
                                                            <strong>BAIRRO</strong>
                                                            <input class="form-control mt-1" type="text" placeholder="Bairro" readonly name="bairro" value="{{$adress->bairro}}" style="width: 358px" />
                                                        </div>

                                                    </div>

                                                    <div class="d-flex" style="width: 100%">
                                                        <div class="px-5 mb-3">
                                                            <strong>CIDADE</strong>
                                                            <input class="form-control mt-1" type="text" placeholder="Cidade" readonly name="cidade" value="{{$adress->no_cidade}}" style="width: 358px" />
                                                        </div>
                                                        <div class="px-5 mb-3">
                                                            <strong>ESTADO</strong>
                                                            <input class="form-control mt-1" type="text" placeholder="Estado" readonly name="estado" value="{{$adress->sg_uf}}" style="width: 358px" />
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-success me-1 mb-1">
                                                        <i data-feather="check-circle"></i>EDITAR
                                                    </button>
                                                    <a href="/fornecedores/{{$fornecedor->id_fornecedor}}" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- fim modal editar endereços -->
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="card-footer">
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
                            <form action="/fornecedores/editar/{{$fornecedor->id_fornecedor}}" method="POST" style="padding: 10px;">
                                @csrf
                                <div class="d-flex mt-10" style="width: 100%">

                                    <div class="px-5 mb-3">
                                        <strong>Razão Social</strong>
                                        <input class="form-control mt-1" type="text" value="{{$fornecedor->de_razao_social}}" placeholder="Razão Social" name="de_razao_social" style="width: 358px" />
                                    </div>

                                    <div class="px-5 mb-3">
                                        <div>
                                            <strong for="raz_social">Nome Fantasia </strong>
                                        </div>
                                        <input class="form-control mt-1" type="text" value="{{$fornecedor->de_nome_fantasia}}" placeholder="Nome Fantasia" name="de_nome_fantasia" style="width: 358px" />
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="px-5 mb-3">
                                        <strong>Inscrição Estadual</strong>
                                        <input class="form-control mt-1" required type="text" value="{{$fornecedor->inscricao_estadual}}" id="insc_estadual" onblur="verificaInput(this)" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                        <span id="erro_insc_estadual"></span>
                                    </div>
                                    <div class="px-5 mb-3">
                                        <strong>CPF/CNPJ</strong>
                                        <input class="form-control mt-1" type="text" value="{{$fornecedor->nu_cpf_cnpj}}" placeholder="CPF/CNPJ" name="nu_cpf_cnpj" style="width: 358px" readonly />
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    <i data-feather="check-circle"></i>Salvar
                                </button>
                                <!-- mudar para produto -->
                                <a href="/fornecedores/{{$fornecedor->id_fornecedor}}" class="btn btn-secondary me-1 mb-1">Cancelar</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="retorno" value="{{$retorno['success']}}">
        <!-- fim modal -->

        <!-- modal de endereços -->
        <div class="me-1 mb-1 d-inline-block">
            <div class="modal fade text-left w-100" id="xlarge_adress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">CADASTRAR ENDEREÇO</h4>
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
                                        <strong>CEP</strong>
                                        <input class="form-control mt-1" type="text" id="cep" placeholder="Cep" name="cep" style="width: 358px" />
                                    </div>
                                </form>
                            </div>
                            <!--Fim formulario para envio de cep para api -->

                            <form action="/enderecos" id="formEndereco" method="POST" style="padding: 10px;">
                                @csrf
                                <div class="d-flex" style="width: 100%">
                                    <div class="px-5 mb-3">
                                        <strong>LOGRADOURO</strong>
                                        <input class="form-control mt-1" type="text" id="logradouro" placeholder="Logradouro" name="logradouro" style="width: 358px" />
                                    </div>
                                    <div class="px-5 mb-3">
                                        <strong>NÚMERO</strong>
                                        <input class="form-control mt-1" type="text" id="numero" placeholder="Número" name="numero" style="width: 358px" />
                                    </div>
                                </div>

                                <div class="d-flex" style="width: 100%">
                                    <div class="px-5 mb-3">
                                        <strong>COMPLEMENTO(OPCIONAL)</strong>
                                        <input class="form-control mt-1" id="complemento" type="text" placeholder="Complemento" name="complemento" style="width: 358px" />
                                    </div>

                                    <div class="px-5 mb-3">
                                        <strong>BAIRRO</strong>
                                        <input class="form-control mt-1" id="bairro" type="text" placeholder="Bairro" name="bairro" style="width: 358px" />
                                    </div>

                                </div>

                                <div class="d-flex" style="width: 100%">
                                    <div class="px-5 mb-3">
                                        <strong>CIDADE</strong>
                                        <input class="form-control mt-1" id="localidade" type="text" placeholder="Cidade" name="cidade" style="width: 358px" />
                                    </div>
                                    <div class="px-5 mb-3">
                                        <strong>ESTADO</strong>
                                        <input class="form-control mt-1" id="uf" type="text" placeholder="Estado" name="estado" style="width: 358px" />
                                    </div>

                                    <div>
                                        <input type="hidden" id="retorno_cep" name="retornoCep" />
                                        <input type="hidden" id="id_provider" name="fornecedor" value="{{$fornecedor->id_fornecedor}}" />
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="button" id="btn_modal" class="btn btn-success me-1 mb-1">
                                    <i data-feather="check-circle"></i>ADICIONAR
                                </button>
                                <a href="/fornecedores/{{$fornecedor->id_fornecedor}}" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal adicionar endereços -->
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    function verificaInput(obj) {
        var erro = document.getElementById("erro_insc_estadual");
        if (obj.value == '') {
            obj.style.borderColor = 'red';
            erro.innerHTML = 'Insira a inscrição estadual';
            erro.style.color = 'red';
        } else {
            obj.style.borderColor = 'green';
            erro.innerHTML = '';
        }
    }

    var retorno = document.getElementById("retorno").value;

    if (retorno == '1') {
        swal({
            title: "Sucesso",
            text: "Fornecedor editado com sucesso!",
            icon: "success",
            button: "OK",
        });
        window.location.href = "{{route('fornecedores')}}";
    } else if (retorno == '0') {
        swal({
            title: "Erro",
            text: "Erro ao editar fornecedor!",
            icon: "error",
            button: "OK",
        });
        window.location.href = "{{route('fornecedores')}}";
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/custom-js/mascara-cnpj-cpf.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/valida-cpf-cnpj.js') }}"></script>

<script>
    $(document).ready(function() {
        var cepRetornado = "";
        var logradouro = "";
        var numero = null;
        var complemento = "";
        var bairro = "";
        var localidade = "";
        var uf = "";

        $("#button_endereco").click(function() {
            // Limpa valores do formulário de cep.
            $("#cep").val("");
            $("#retorno_cep").val("");
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
                    $("#retorno_cep").val("...");
                    $("#logradouro").val("...");
                    $("#numero").val("...");
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

                                cepRetornado = $("#retorno_cep").val(dados.cep);
                                logradouro = $("#logradouro").val(dados.logradouro);
                                complemento = $("#complemento").val(dados.complemento);
                                numero = $("#numero").val('');
                                bairro = $("#bairro").val(dados.bairro);
                                localidade = $("#localidade").val(dados.localidade);
                                uf = $("#uf").val(dados.uf);


                                //TRANSFORMA OS CAMPOS EM READONLY
                                $("#localidade").prop('readonly', true);
                                $("#uf").prop('readonly', true);
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
        //comecei daqui o endereco dinamico

        $("#btn_modal").click(function() {
            if (
                cepRetornado == "" ||
                logradouro == "" ||
                bairro == "" ||
                localidade == "" ||
                uf == ""
            ) {
                alert("Preencha todos os campos!");
            } else {
                numero = $("#numero").val();

                $("#logradouro").attr('name', 'logradouro[]').attr('value', logradouro.val());
                $("#bairro").attr('name', 'bairro[]').attr('value', bairro.val());
                $("#localidade").attr('name', 'localidade[]').attr('value', localidade.val());
                $("#uf").attr('name', 'uf[]').attr('value', uf.val());
                $("#numero").attr('name', 'numero[]').attr('value', numero);
                $("#complemento").attr('name', 'complemento[]').attr('value', complemento.val());
                $("#cep").attr('name', 'cep[]').attr('value', cepRetornado);

                document.getElementById("formEndereco").submit();
            }
        });

    });

    function removeEndereco(id) {
        $("#gerado_" + id).remove();
        $("#" + id).remove();
    }

    function limpaCampos() {
        $("#cep").val("");
        $("#retorno_cep").val("");
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#localidade").val("");
        $("#uf").val("");
        $("#numero").val("");
        $("#complemento").val("");
    }
</script>

<script>
    function deleteAdress(obj) {
        let id = obj.replace('endereco_', '');
        Swal.fire({
            title: 'Atenção!',
            text: "Deseja Realmente Excluir este Endereço?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#820AD1',
            cancelButtonColor: '#D1611F',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/enderecos/delete/' + id,
                    type: 'post',
                    data: {
                        _token: $('input[name=_token]').val()
                    },
                    success: function(data) {
                        if (!("error" in data)) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Deletado',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Erro ao deletar',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            }
        });
    }
</script>



@endsection
