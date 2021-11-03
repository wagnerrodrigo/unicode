@extends('layouts.templates.template')
@section('title', 'Lista Despesas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <form action="#" method="post" id="formCep">
                @csrf
                <input type="text" name="cep" id="cep" placeholder="Digite seu CEP">
            </form>
        </div>

        <div class="card-body">
            <strong>
                Cep:
            </strong>
            <span id="retornoCep"></span>
        </div>

        <div class="card-body">
            <strong>
                logradouro:
            </strong>
            <span id="logradouro"></span>
        </div>

        <div class="card-body">
            <strong>
                complemento:
            </strong>
            <span id="complemento"></span>
        </div>

        <div class="card-body">
            <strong>
                bairro:
            </strong>
            <span id="bairro"></span>
        </div>

        <div class="card-body">
            <strong>
                Cidade:
            </strong>
            <span id="localidade"></span>
        </div>

        <div class="card-body">
            <strong>
                Estado:
            </strong>
            <span id="uf"></span>
        </div>
    </div>
</div>
@endsection

<script src="assets/js/feather-icons/feather.min.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/vendors.js"></script>

<script src="assets/js/main.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#localidade").val("");
            $("#uf").val("");
        }

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
                    $("#retornoCep").html("...");
                    $("#logradouro").html("...");
                    $("#complemento").html("...");
                    $("#bairro").html("...");
                    $("#localidade").html("...");
                    $("#uf").html("...");


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

                                $("#retornoCep").html(dados.cep);
                                $("#logradouro").html(dados.logradouro);
                                $("#complemento").html(dados.complemento);
                                $("#bairro").html(dados.bairro);
                                $("#localidade").html(dados.localidade);
                                $("#uf").html(dados.uf);
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