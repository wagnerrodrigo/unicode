@extends('layouts.templates.template')
@section('title', 'Cotação Compra')

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


Fornecedor: Escolher fornecedor cadastrado e permitir inclusão se não tiver, com informações básicas (Nome, CNPJ, Contato) *
Valor do Produto: *
Valor de frete: * (automaticamente vir como R$ 0,00, mas permitir alterar)
Condição de Pagamento: escolher uma condição de pagamento cadastrada *
Prazo de Entrega:
Observação: texto livre
Incluir anexos por cotação

-->
  
  <br>
  <div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
      <div class="card">
        <div class="card-header">
          <h1>REALIZANDO COTAÇÃO</h1>
        </div>
        <center>

        

        <form class="row g-4" style="width: 90%;" method="POST">
          @csrf
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nome do solicitante</label>
              <input type="text" class="form-control" id="inputEmail4" name="nome" value="{{$cotacao->nome_empregado}}" disabled="disabled" required>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">CPF do Solicitante</label>
              <input type="text" class="form-control" name="cpf" id="inputPassword4" value="{{$cotacao->nu_cpf_cnpj}}" disabled="disabled" required>
            </div>

            <br>
            <div class="col-md-6">
              <label for="exampleDataList" class="form-label">Filial</label>
              <input class="form-control" list="datalistOptions" name="filial" id="exampleDataList" value="{{$cotacao->de_empresa}}" disabled="disabled" required>
              <datalist id="datalistOptions">
              </datalist>
            </div>

            <div class="col-md-6">
              <label for="exampleDataList" class="form-label">Departamento</label>
              <input class="form-control" list="datalistOptions1" name="departamento" value="{{$cotacao->de_cargo_funcional}}" id="exampleDataList" disabled="disabled" required>
              <datalist id="datalistOptions1">
              </datalist>
            </div>
            
</center>
<hr>

<div class="accordion" id="accordionExample" >
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
      {{$cotacao->de_produto}}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        
         <div class="col-md-4" style="display: inline-block">
          <label for="inputState" class="form-label">Categoria</label>
          <select id="inputState" name="categoria" class="form-select" required>
            <option>{{$cotacao->de_tipo_produto}}</option>
          </select>
        </div>

        <div class="col-md-4" style="display: inline-block">
          <label for="disabledSelect" class="form-label">Centro de Custo</label>
          <select id="disabledSelect" name="centro_custo" class="form-select" required>
            <option>1</option>
          </select>
        </div>

        @foreach($produtos as $produto)
<br><br>
        <div class="col-4" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Produto</label>
          <input type="text" class="form-control" name="produto" id="inputPassword4" value="{{$produto->de_produto}}" required>
        </div>

        <div class="col-2" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Quantidade</label>
          <input type="number" class="form-control" name="valor_produto" id="inputPassword4" value="{{$produto->quantidade}}" min="1" required>
        </div>

        <div class="col-3" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Unidade Medida</label>
          <input type="number" class="form-control" name="valor_produto" id="inputPassword4" value="{{$produto->unidade_medida}}" min="1" required>
        </div>
<br><br>
        <div class="col-2" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Valor do Produto</label>
          <input type="text" class="form-control" name="valor_produto" id="inputPassword4" value="R$ 0,00" required>
        </div>

        <div class="col-2" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Valor do Frete</label>
          <input type="text" class="form-control" name="frete" id="inputPassword4" value="R$ 0,00" required>
        </div>

        <div class="col-3" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Prazo de Entrega:</label>
          <input type="date" class="form-control" name="prazo_entrega" id="inputPassword4" required>
        </div>

        <div class="col-3" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Condição de Pagamento:</label>
          <input type="text" class="form-control" name="condição_pagamento" id="inputPassword4" required>
        </div>
<br><br>
        <div class="col-3" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Nome do Fornecedor</label>
          <input type="text" class="form-control" name="nomeFornecedor" id="inputPassword4" required>
        </div>

        <div class="col-2" style="display: inline-block">
          <label for="inputPassword4" class="form-label">CNPJ do Fornecedor</label>
          <input type="text" class="form-control" name="cnpjFornecedor" id="inputPassword4" required>
        </div>

        <div class="col-3" style="display: inline-block">
          <label for="inputPassword4" class="form-label">Contato do Fornecedor</label>
          <input type="text" class="form-control" name="contatoFornecedor" id="inputPassword4" required>
        </div>
        @endforeach  
      </div>
    </div>
  </div>
</div>
     
<hr>

        <div class="form-floating">
          <textarea class="form-control" name="complemento" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
          <label for="floatingTextarea2">Observação</label>
        </div>
<br>
<center>
        <div class="col-1" style="display: inline-block">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        </form>

        <div class="col-1" style="display: inline-block">
          <a href="{{route('home')}}"> 
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
              <font color="blue">Cancelar</font>  
            </button></a>
        </div>
</center>
      </div>
    </div>
  </div>

  @endsection
