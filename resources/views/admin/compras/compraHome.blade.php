@extends('layouts.templates.template')
@section('title', 'Compra')

@section('content')
<!-- <meta http-equiv="refresh" content="20"> -->
  <br>


  
  <div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
      <div class="card">
        <div class="card-header">
          <a href="{{route('solicitar')}}"> 
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
          <font color="blue">  <i class="bi bi-plus-circle"></i> Registrar nova compra</font>  
          </button></a>
        </div>

<br>
        
    <form class="col-md-12">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <div class="col-md-3" style="display: inline-block">
        <input class="form-control me-2" type="search" placeholder="Buscar por Solicitante" aria-label="Search">
      </div>

      <div class="col-md-3" style="display: inline-block">
        <div class="input-group mb-3" style="width: 250px">
          <label class="input-group-text" for="inputStatus">STATUS</label>
          <select class="form-select" id="inputStatus" name="status">
            <option value=""></option>
            <option value="6">Pedido Entregue</option>
            <option value="4">Compra Liberada</option>
            <option value="5">Análise Financeiro</option>
            <option value="2">Em Cotação</option>
            <option value="1">Análise da Diretoria da Área</option>
          </select>
        </div>
      </div> 

      <div class="col-md-3" style="display: inline-block">
        <div class="input-group mb-3" style="width: 250px">
          <label class="input-group-text" for="inputDataInicio">DATA INICIO</label>
          <input class="form-control" value="{{$dt_inicio ?? ''}}" type="date" max="" name="dt_inicio" id="inputDataInicio">
        </div>
      </div>

      <div class="col-md-2" style="display: inline-block">
        <div class="input-group mb-3" style="width: 250px">
          <label class="input-group-text" for="inputDataFim">DATA FIM</label>
          <input class="form-control" value="{{$dt_fim ?? ''}}" type="date" min="" name="dt_fim" id="inputDataFim">
        </div>
      </div>

      <center><button class="btn btn-outline-success" type="submit">Buscar</button></center>
    </form>
 

        <br>
        <table class="table table-striped table-hover">
          <tr>
            <th>ID</th>
            <th>SOLICITAÇÃO</th>
            <th>PRODUTO</th>
            <th>SETOR</th>
            <th>DATA</th>
            <th>STATUS</th>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AÇÕES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
          </tr>

      <tbody>
          @foreach($pedidos as $pedido) 
      <tr>
            <td >{{$pedido->id_solicitacao_compra}}</td>  <!-- *id* da solicitacao de compra -->
            <td>{{$pedido->nome_empregado}}</td> <!-- *nome* do Solicitante -->
            <td>{{$pedido->de_produto}}...</td> <!-- *Nome produto* -->
            <td>{{$pedido->de_cargo_funcional}}</td> <!-- *Departamento* do Solicitante -->
            <td>{{date("d/m/Y", strtotime($pedido->data_pedido))}}</td> <!-- *Data* da solicitação -->
            <td> @if($pedido->status_atual == 'Análise da Diretoria da Área') <!-- *Status Atual* -->
              <font color="blue">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Em Cotação')
                <font color="green">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Análise Financeiro')
              <font color="blue">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Compra Liberada')
              <font color="green">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Pedido Entregue')
              <font color="green">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Reprovado')
              <font color="red">{{$pedido->status_atual}}</font></td>

              @elseif($pedido->status_atual == 'Solicitação Cancelada')
              <font color="red">{{$pedido->status_atual}}</font></td>

          
              @else
              {{$pedido->status_atual}}
              @endif
              
            @if($pedido->status_atual == 'Análise da Diretoria da Área')
            <td>
                <a href="#staticBackdrop-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px; " data-bs-target="#staticBackdrop-{{$pedido->id_solicitacao_compra}}"><i class="bi bi-eye-fill"></i></a>
                <a href="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;" data-bs-target="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}"><i class="bi bi-file-earmark-text"></i></a>        
                <a href="{{route('showDiretoria',$pedido->id_solicitacao_compra)}}" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px; " class="btn btn-primary"><i class="bi bi-check-circle"></i></a>
                <a href="" class="btn btn-primary" style="padding-left: 15px ; padding-right:15px ; " ><i class="bi bi-trash"></i></a>
            </td>
            
            @elseif($pedido->status_atual == 'Em Cotação')
            <td>
                <a href="#staticBackdrop-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$pedido->id_solicitacao_compra}}" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i class="bi bi-eye-fill"></i></a>
                <a href="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i class="bi bi-file-earmark-text"></i></a>        
                <a href="{{route('showCotacao',$pedido->id_solicitacao_compra)}}" class="btn btn-primary" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i class="bi bi-cash-coin"></i></a>
            </td>
            
            @else
            <td>
                <a href="#staticBackdrop-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$pedido->id_solicitacao_compra}}" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i class="bi bi-eye-fill"></i></a>
                <a href="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1-{{$pedido->id_solicitacao_compra}}" style="padding-left: 15px ; padding-right:15px ; margin-right: 5px;"><i class="bi bi-file-earmark-text"></i></a>   
            </td>
            @endif

      </tbody>

            <!-- Detalhes -->
            <div class="modal fade" id="staticBackdrop-{{$pedido->id_solicitacao_compra}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalhes da Solicitacao: {{$pedido->id_solicitacao_compra}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <div class="container">
                      <div class="row">
                        <div class="col-sm-5">Nome do solicitante: {{$pedido->nome_empregado}}</div>
                        <div class="col-sm-5">CPF do solicitante: {{$pedido->nu_cpf_cnpj}}</div>
                    <br><hr><br>
                        <div class="col-sm-5">Filial: {{$pedido->de_empresa}}</div>
                        <div class="col-sm-5">Departamento: {{$pedido->de_cargo_funcional}} </div>
                        <div class="col-sm-5">Centro de Custo: </div>

                                
                     @foreach($produtos as $produto)
                     
                      <br><br><hr><br>
                      <div class="col-sm-4">Id: {{$produto->fk_tab_solicitacao_compra_id}}</div>
                      <div class="col-sm-5">Categoria do Produto: {{$pedido->de_tipo_produto}}</div>
                      <div class="col-sm-4">Produto: {{$produto->de_produto}}</div>
                      <div class="col-sm-4">Quantidade: {{$produto->quantidade}} </div>
                      <div class="col-sm-4">Unidade Medida: {{$produto->unidade_medida}} </div>
                     
                     @endforeach

                    <br><br><hr><br>
                        <div class="col-sm-6">Complemento: {{$pedido->complemento_solicitacao}}</div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Historico -->
            <div class="modal fade" id="staticBackdrop1-{{$pedido->id_solicitacao_compra}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalhes da Solicitacao: {{$pedido->id_solicitacao_compra}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Solicitado por {{$pedido->nome_empregado}} <br>
                    Descrição: {{$pedido->complemento_solicitacao}} <br> <hr>
                    Status atual: {{$pedido->status_atual}} <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </table>

      </div>
    </div>
  </div>
  @endsection

