@extends('layouts.templates.template')
@section('title', 'Lista Fornecedores')

@section('content')
<!-- Inicio Modal Adicionar-->
<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>FORNECEDOR/PRESTADOR</h1>
            </div>
            <div class="card-body d-flex justify-content-center">
                <!--inicio Tab -->
                <div class="tab-content text-justify">
                    <!--inicio Tab Despesas-->
                    <div class="justify-content-center " id="list-despesa">
                        <form action="{{route('fornecedores')}}" method="POST" style="padding: 10px;">
                            @csrf
                            <div class="d-flex">
                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>PESQUISA CNPJ RECEITA FEDERAL</strong>
                                        <input class="form-control mt-1" id="pesqCNPJ" type="text" placeholder="Pesquisa CNPJ"
                                        name="pesqCNPJ" style="width: 150px"/>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-10" style="width: 100%">
                                <div id="enderecos_gerados"></div>

                                <div class="px-5 mb-3">
                                    <strong>NOME FANTASIA</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Nome" name="de_nome_fantasia" id="de_nome_fantasia" style="width: 358px" />
                                </div>
                                <div class="px-5 mb-3">
                                    <strong>RAZÃO SOCIAL</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Razão Social" name="de_razao_social" id="de_razao_social" style="width: 358px" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>INSCRIÇÃO ESTADUAL</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>CPF/CNPJ</strong>
                                        <input class="form-control mt-1" type="text" placeholder="CPF/CNPJ" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur="verificaCPFCNPJ(this.value)" onkeyup="return validaCpfCnpj(this.value);" maxlength="18" onblur='clearTimeout()' id="nu_cpf_cnpj" name="nu_cpf_cnpj" style="width: 358px" />
                                        <span id="invalid_cpf_cnpj"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>Representante Legal</strong>
                                    <input class="form-control mt-1" type="text" placeholder="Incrição estadual" name="inscricao_estadual" style="width: 358px" />
                                </div>

                                <div class="px-5 mb-3">
                                    <div>
                                        <strong>CPF Representante Legal</strong>
                                        <input class="form-control mt-1" type="text" placeholder="CPF/CNPJ" name="nu_cpf_cnpj" style="width: 358px" />
                                    </div>
                                </div>
                            </div> --}}
                    </div>

                    <div class="d-flex" style="width: 100%">
                        <div class="px-5 mb-3">
                            <h3>ENDEREÇO</h3>
                            <button class="btn btn-primary" onclick="return limpaCampos()" type="button" data-bs-toggle="modal" data-bs-target="#xlarge">
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
                                        <th>CEP</th>
                                        <th>LOGRADOURO</th>
                                        <th>NUMERO</th>
                                        <th>COMPLEMENTO</th>
                                        <th>BAIRRO</th>
                                        <th>CIDADE</th>
                                        <th>UF</th>
                                        <th>REMOVER</th>
                                    </tr>
                                </thead>
                                <tbody id="table_endereco">
                                    <!-- aqui são gerados os campos do endereço -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Fim da tabela de itens -->
                    </div>

                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" id="btn_cadastra_fornecedor" disabled class="btn btn-success me-1 mb-1">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
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

                    <form style="padding: 10px;">

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
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="button" id="btn_modal" class="btn btn-success me-1 mb-1">
                            <i data-feather="check-circle"></i>ADICIONAR
                        </button>
                        <a href="{{route('fornecedores')}}" class="btn btn-secondary me-1 mb-1">CANCELAR</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal Adicionar -->

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

                $("#enderecos_gerados").append(
                    `<div id="gerado_${cepRetornado.val()}">` +
                    `<input type="hidden" name="cep[]" value="${cepRetornado.val().toUpperCase()}" />` +
                    `<input type="hidden" name="logradouro[]" value="${logradouro.val().toUpperCase()}" />` +
                    `<input type="hidden" name="numero[]" value="${numero}"/>` +
                    `<input type="hidden" name="complemento[]" value="${complemento.val().toUpperCase()}" />` +
                    `<input type="hidden" name="bairro[]" value="${bairro.val().toUpperCase()}" />` +
                    `<input type="hidden" name="localidade[]" value="${localidade.val().toUpperCase()}" />` +
                    `<input type="hidden" name="uf[]" value="${uf.val().toUpperCase()}" />` +
                    `</div>`
                );

                $("#table_endereco").append(
                    `<tr id="${cepRetornado.val()}">` +
                    `<td>${cepRetornado.val()}</td>` +
                    `<td>${logradouro.val()}</td>` +
                    `<td>${numero}</td>` +
                    `<td>${complemento.val()}</td>` +
                    `<td>${bairro.val()}</td>` +
                    `<td>${localidade.val()}</td>` +
                    `<td>${uf.val()}</td>` +
                    `<td><button onclick="removeEndereco('${cepRetornado.val()}')" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button></td>` +
                    "</tr>"
                );

                limpaCampos();
            }
        });

        $("#pesqCNPJ").blur(function(){
                // CNPJ vai receber somente numeros
                var cnpj = $(this).val().replace(/\D/g, '');
                console.log("estou funcionado ");

                if (cnpj != ""){
                 getCnpj(cnpj);
                }
            });
    });

    function getCnpj(cnpj){
        $.ajax({
            url:`/cep/pesquisaCNPJ/${cnpj}`,
            type: 'GET',
            dataType: "json",
            success: function(data){
                inputCnpj = $("#nu_cpf_cnpj").val(data.estabelecimento.cnpj);
                inputRazao_social = $("#de_razao_social").val(data.razao_social);
                inputNome_fantasia = $("#de_nome_fantasia").val(data.estabelecimento.nome_fantasia);
                swal({
                    title:"CNPJ Encontrado",
                    text: "Por favor verifique os campos Nome Fantasia e Inscrição Estadual",
                    icon: "success",
                    button: "OK",
                })
            },
            error: function () {
                swal({
                    title: "Erro",
                    text: "Erro ao buscar o CNPJ da receita federal",
                    icon: "error",
                    button: "Ok",
                });
            },
        });
    }


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

    function verificaCPFCNPJ(valor) {
        var documento = valor.replace(/\D/g, '');
        $.ajax({
                url: `/fornecedores/cnpj_cpf/${documento}`,
                type: "GET",
                dataType: "json",
            })
            .done(function(response) {
                console.log(response);
                if (response != "") {
                    $("#nu_cpf_cnpj").focus();
                    invalid_cpf_cnpj.innerHTML = "CPF/CNPJ já cadastrado!";
                    invalid_cpf_cnpj.style.display = 'block';
                    invalid_cpf_cnpj.style.color = 'red';
                    btn_cadastra_fornecedor.disabled = true;
                } else {
                    invalid_cpf_cnpj.innerHTML = "";
                    btn_cadastra_fornecedor.disabled = false;
                }
            })
            .fail(function(response) {
                console.log(response);
            });
    }
</script>


@endsection
