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
          <center>

          <form class="row g-4" style="width: 90%;" method="POST">
            @csrf
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nome do solicitante:</label>
              <input type="text" class="form-control" id="inputEmail4" name="nome" value="{{@SESSION('name')}}" disabled="disabled" required>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">CPF do Solicitante:</label>
              <input type="text" class="form-control cpf-mask" name="cpf" value="{{@SESSION('login')}}" maxlength="11" disabled="disabled" required>
            </div>

            <div class="col-md-6">
              <label for="listaFilial" class="form-label">Filial</label>
              <select type="text" id="listaFilial" name="filial" class="form-select" required>
                <option onchange="myFunction()"></option>
                <option>1</option>
              </select>
            </div>

            <br>

            <div class="col-md-6">
              <label for="listaDepartamento" class="form-label">Departamento</label>
              <select type="text" id="listaDepartamento" name="departamento" class="form-select" required>
                <option onchange="myFunction()"></option>
                <option>1</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="listaCentro_custo" class="form-label">Centro de Custo</label>
              <select type="text" id="listaCentro_custo" name="centro_custo" class="form-select" required>
                <option onchange="myFunction()"></option>
                <option>1</option>
              </select>
            </div>

            <hr>

            <div class="d-flex" style="width: 100%; align-items:center">
                        <div class="px-5 mb-3">
                            <h3>Produtos</h3>
                        </div>
            </div>

              <div class="d-flex" style="width: 100%; margin: 15px;">
                  <!-- Inicio da tabela de itens -->
                  <div class="px-5 mb-4">
                      <div class="table-responsive">
                          <div class="d-flex flex-row" style="padding:40px; align-items:center; border: 1px solid #ccc">
                              <div class="inserirProd_Ser" info-geral="Categoria" style="padding:15px">
                                  <select class="form-control mt-1" id="classificacao_tipo_produto" style="width: 190px">
                                      <option selected value=""></option>
                                  </select>
                              </div>

                              <div class="inserirQuant" info-categoria="Produto ou Serviço" style="padding:30px">
                                  <select class="form-control input-add mt-1" id="produto_servico" placeholder="Produto ou Servico" style="width: 190px"></select>
                              </div>

                              <div class="inserirDesc" style="padding:15px">
                                  <input class="form-control mt-1" id="quantidade" type="text" onkeyup="return onlynumber();" onblur="validaqtdItem(this)" autocomplete="off" placeholder="Quantidade" style="width: 180px" />
                              </div>

                              <div class="form-floating">
                                <textarea class="form-control" name="descricao" maxlength="500" rows="30" cols="50" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Descrição do Produto</label>
                              </div>

                              <div style="padding:15px">
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
                                      <th>DESCRIÇÃO</th>
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

            <hr>


            <div class="form-floating">
              <textarea class="form-control" name="complemento" maxlength="500" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Complemento / Motivo de Compra</label>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Solicitar Compra</button> <br><br><br>
            </div>
          </form>


        </div>
      </div>
    </div>
  </center>




  <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  @endsection
</body>

</html>