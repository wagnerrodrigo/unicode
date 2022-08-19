<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compras\Pedido;
use App\Models\Compras\Produto;
use App\Utils\StatusPedido;
use Carbon\Carbon;

class SolicitarCompraController extends Controller
{
    public function index()
    {
        return view('admin.compras.solicitarCompra');
    }

    public function store(Request $request)
    {

        $purchase = new Pedido();
        $purchase->fk_tab_empregado_id        = 6;
        $purchase->fk_tab_cargo_funcional_id  = 5;
        $purchase->fk_tab_empresa_id          = 5;
        $purchase->fk_tab_carteira_id         = 2;
        $purchase->fk_tab_status_pedido_id    = StatusPedido::ANALISE_DIRETORIA_AREA;
        $purchase->complemento_solicitacao    = $request->complemento;
        $purchase->data_pedido                = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        $purchase->fim_pedido                 = null;

       
        
       $purchase->salvarPedido($purchase);
    

  
     $timestamp = $purchase->data_pedido;
     $id_solicitacao_compra = Pedido::findByTimeStamp($timestamp);
          

        $produto = new Produto();
        $produto->fk_tab_solicitacao_compra_id  = $id_solicitacao_compra->id_solicitacao_compra;
        $produto->fk_tab_produto_id             = 1;
        $produto->fk_tab_tipo_produto_id        = 2;
        $produto->quantidade                    = 2;
        $produto->complemento_produto           = $request->descricao;
        
        
        $produto->salvarProduto($produto);


        return redirect('/compras');

    }
    
}
