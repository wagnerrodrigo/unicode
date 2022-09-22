@extends('layouts.templates.template')
@section('title', 'Solicitar Compra')

@section('content')

  <!-- 
Id da Solicitação: gerado automaticamente
Data: preenchimento automático

Nome do solicitante: preenchimento automático
CPF do Solicitante: preenchimento automático

Coligada: escolher uma coligada cadastrada *
Filial: escolher uma filial cadastrada *
Área destinada: escolher um departamento cadastrado *
Centro de Custo: escolher um Centro de Custo cadastrado *
Categoria do Produto (escolher categorias previamente cadastradas) *
Produto (escolher produtos previamente cadastrados) *
Quantidade: *
Unidade de Medida: *
-->

  <br>

<div id="main" style="margin-top: 5px;">
  <div class="main-content container-fluid">
    <div class="card">
      <div class="card-header">
        <h1>SOLICITANDO COMPRA</h1>
      </div>
      <center>

      <form class="row g-4" style="width: 90%;" method="POST">
        @csrf
        <div id="hidden_inputs_itens"></div>
        <div class="col-md-6">
          <strong>NOME DO SOLICITANTE</strong>
          <input type="text" required class="form-control" id="nome_usuario" name="nome" value="{{@SESSION('name')}}" disabled="disabled" required>
        </div>

        <div class="col-md-6">
        <strong>CPF DO SOLICITANTE</strong>
          <input type="text" required class="form-control cpf-mask" id="cpf_usuario" name="cpf" value="{{@SESSION('login')}}" maxlength="11" disabled="disabled" required>
        </div>

        <div class="col-md-6">
            <strong>EMPRESA</strong>
            <input style="width: 100%" required type="text"  id="busca_empresa" value="" placeholder="Digite o nome da empresa" autocomplete="off" class="form-control input-busca" />
            <div id="results_empresa" class="resultado-busca"></div>
        </div>

        <div class="col-md-6">
            <strong>CENTRO DE CUSTO</strong>
            <select style="width: 100%" required type="text"  id="empresa" value="" placeholder="Digite o Centro de custo" autocomplete="off" class="form-control" >
              <option selected value="" class="resultado-busca"></option>
            </select>
        </div>

<center>
        <div class="col-md-6">
          <strong>DEPARTAMENTO</strong>
          <input style="width: 100%" required type="text"  id="" value="" placeholder="Digite o Departamento" autocomplete="off" class="form-control" />
          <div id="" class=""></div>
        </div>
</center>
        <hr>
<center>
        <div class="d-flex"id="btnDespesa"  style="width: 100%; align-items:center">
                    <div class="px-5 mb-3">
                        <h3>Produtos</h3>
                    </div>
        </div>

          <div class="d-flex" style="width: 105%; margin: 0px;">
              <!-- Inicio da tabela de itens -->
              <div class="px-12 mb-12">
                  <div class="table-responsive">
                      <div class="d-flex flex-row" style="padding:8px; align-items:center; border: 1px solid #ccc">
                      
                          <div class="inserirProd_Ser" info-geral="Categoria" style="padding:10px">
                              <select class="form-control mt-1" id="classificacao_tipo_produto" style="width: 190px">
                                  <option selected value=""></option>
                              </select>
                          </div>

                          <div class="inserirQuant" info-categoria="Produto ou Serviço" style="padding:10px">
                              <select class="form-control input-add mt-1" name="produto_servico" id="produto_servico" placeholder="Produto ou Servico" style="width: 190px"></select>
                          </div>

                          <div class="inserirDesc" info-categoria="Quantidade" style="padding:10px">
                              <input class="form-control mt-1" id="quantidade" type="text"  onblur="validaqtdItem(this)" autocomplete="off" placeholder="Quantidade" style="width: 130px" />
                          </div>

                          <div class="inserirDesc" info-categoria="Valor" style="padding:10px">
                              <input class="form-control mt-1" id="valor_item" type="text" autocomplete="off" onkeyup="mask_valor();" placeholder="Valor" style="width: 130px" />
                          </div>

                          <div class="inserirDesc" info-categoria="Unidade Medida" style="padding:10px">
                              <input class="form-control mt-1" id="unidadeMedida" type="text" autocomplete="off" placeholder="Unidade Medida" style="width: 220px" />
                          </div>

                          <div style="padding:10px">
                              <button class="btn btn-primary" type="button" id="Prod" style="width: 2.5rem; padding: 6.5px; margin-top: 3px">
                                  <i class="bi bi-plus"></i>
                              </button>
                          </div>

                          <div id="acao_dados" style="display:none;"></div>
                      </div>
                      <table class="table table-bordered mb-0">
                          <thead>
                              <tr>
                                  <th>CLASSIFICAÇÃO</th>
                                  <th>PRODUTO</th>
                                  <th>QUANTIDADE</th>
                                  <th>VALOR</th>
                                  <th>UNIDADE MEDIDA</th>
                                  <th>AÇÃO</th>
                              </tr>
                      </thead>
                        <tbody id="Tb">

                        </tbody>
                      </table>
              </div>
          </div>
              <!-- Fim da tabela de produtos -->
        </div>
          <!-- Fim da div da tabela de produtos -->
</center>
<hr>
            <div class="d-flex"id="btnDespesa"  style="width: 100%; align-items:center">
              <div class="px-5 mb-3">
                  <h3>Anexar Documento (Opcional)</h3>
              </div>
            </div>
            <input type="file" id="img" name="salvarImagem" accept="image/png, image/jpeg">
<hr>
<center>
            <div class="form-floating">
              <textarea class="form-control" name="complemento_solicitacao" maxlength="500" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" require></textarea>
              <label for="floatingTextarea2" required>Complemento / Motivo de Compra</label>
            </div>
<br>
            <div class="col-2" style="display: inline-block">
              <button type="submit" class="btn btn-primary">Solicitar Compra</button>
            </div>
          </form>


          <div class="col-1" style="display: inline-block">
            <a href="{{route('home')}}"> 
              <button class="btn btn-success">
                <font color="blue">Cancelar</font>  
              </button>
            </a>
          <div>

        </div>
      </div>
    </div>
  </center>


<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<!-- javascript customizado -->
<script src="{{ asset('assets/js/custom-js/solictar-compra.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/validacao-only-number.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="{{ asset('assets/js/custom-js/mascara-cnpj-cpf.js') }}"></script>

<script>

  function mask_valor(){
		var n_char = document.getElementById("valor_item").value.length;

		if(n_char == 2){
			document.getElementById("valor_item").value = "R$" + document.getElementById("valor_item").value + ",";
	  	}   
  }

</script>

  @endsection
</body>

</html>