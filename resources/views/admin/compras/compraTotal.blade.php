@extends('layouts.templates.template')
@section('title', 'Compra')

@section('content')
<meta http-equiv="refresh" content="20">
  <br>
  <center>
    <form class="col-md-4">
      <input class="form-control me-2" type="search" placeholder="Buscar Compra" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </center>

        <br>
        <table class="table table-striped">
          <th>ID</th>
          <th>Solicitante</th>
          <th>Produto</th>
          <th>Setor</th>
          <th>Data</th>
          <th>Status</th>
          <th>Detalhes</th>
          <th>Historico</th>
        
        
          @foreach($pedidos as $pedido) 
      <tr>
            <td>{{$pedido->id_solicitacao_compra}}</td> <!-- *id* da solicitacao de compra -->
            <td>{{$pedido->nome_empregado}} </td> <!-- *nome* do Solicitante -->
            <td>{{$pedido->de_produto}}</td> <!-- *Nome produto* -->
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

              @else($pedido->status_atual == 'Solicitação Cancelada')
              <font color="red">{{$pedido->status_atual}}</font></td>

              @endif
              
              
            <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-binoculars"></i></a></td>
            <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-file-earmark-text"></i></td>
            
            <!-- Detalhes -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalhes</h5>
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
                        <div class="col-sm-5">Categoria do Produto: {{$pedido->de_tipo_produto}}</div>
                        <div class="col-sm-5">Centro de Custo: </div>
                    <br><br><hr><br>
                        <div class="col-sm-4">Produto: {{$pedido->de_produto}}</div>
                        <div class="col-sm-4">Quantidade: {{$pedido->quantidade}} </div>
                        <div class="col-sm-4">Descrição: {{$pedido->complemento_produto}} </div>
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
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Solicitado por {{$pedido->nome_empregado}} <br>
                    Descrição: {{$pedido->complemento_solicitacao}} <br> <hr>
                    Status: {{$pedido->status_atual}} <br>
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

