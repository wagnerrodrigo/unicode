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
            <h1>APROVAÇÃO</h1>
          </div>
<center>
          <form class="row g-4" style="width: 90%;" method="POST">
            @csrf

         
            <div class="col-sm-5">Nome do solicitante: {{$diretoria->nome_empregado}}</div>
            <div class="col-sm-5">CPF do solicitante: {{$diretoria->nu_cpf_cnpj}}</div>
            <div class="col-sm-5">Filial: {{$diretoria->de_empresa}}</div>
            <div class="col-sm-5">Departamento: {{$diretoria->de_cargo_funcional}}</div>
            <div class="col-sm-5">Centro de Custo: </div>
        <br><br><hr><br>
        
        @foreach($produtos as $produto)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$produto->de_produto}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Quantidade: {{$produto->quantidade}}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{$produto->de_tipo_produto}}</h6>
                    <p class="card-text">{{$produto->unidade_medida}}</p>
                </div>
                <input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" checked>
                <label class="btn btn-outline-success" for="success-outlined">Aprovado</label>
                <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
                <label class="btn btn-outline-danger" for="danger-outlined">Reprovado</label>
              </div>


        <br><br><hr><br>
                  <div class="col-sm-5">Complemento da Solicitação: {{$diretoria->complemento_solicitacao}}</div> <br><br><br><br>
                </div>
            </div>
            @endforeach
<center>

            <div class="form-floating">
              <textarea class="form-control" name="complemento" maxlength="500" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
              <label for="floatingTextarea2">Complemento</label> 
            </div>
<br>
            <div class="col-2" style="display: inline-block">
              <button type="submit" class="btn btn-primary">Enviar para Cotação</button> 
            </div>
          </form>

     
          <div class="col-1" style="display: inline-block">
            <a href="{{route('home')}}"> 
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                <font color="blue">Cancelar</font>  
              </button>
            </a>
          <div>
</center>
<br><br><br>
        </div>
      </div>
    </div>
  </center>
 
  @endsection
