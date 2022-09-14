<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compras\Pedido;
use App\Models\Compras\Produto;
use App\Repository\EmpresaRepository;
use App\Repository\ProdutoCompraRepository;
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
        
        $empresaRepository = new EmpresaRepository();
        $empresa = $empresaRepository->getEmpresas();

        $purchase = new Pedido();
        $purchase->fk_tab_empregado_id        = 6;
        $purchase->fk_tab_cargo_funcional_id  = 5;
        $purchase->fk_tab_empresa_id          = 5;
        $purchase->fk_tab_carteira_id         = 2;
        $purchase->fk_tab_status_pedido_id    = StatusPedido::ANALISE_DIRETORIA_AREA;
        $purchase->complemento_solicitacao    = $request->complemento_solicitacao;
        $purchase->data_pedido                = Carbon::now()->setTimezone('America/Sao_Paulo')->toDateTimeString();
        $purchase->fim_pedido                 = null;

       
       
       $purchase->salvarPedido($purchase);
    

    
     $timestamp = $purchase->data_pedido;
     $fk_tab_solicitacao_compra_id = Pedido::findByTimeStamp($timestamp);
     if ($request->id_produto) {
        $itensProduto = [];
        //percorre os arrays de centro_custo, valor, e porcentagem do rateio recebidos pelo request e os une em um array chamado $rateios[]
        for ($i = 0; $i < count($request->id_produto); $i++) {
            $itensProduto[] = [
                'fk_tab_produto_id' => $request->id_produto[$i],
                'fk_tab_tipo_produto_id' => $request->classificacao_tipo_produto[$i],
                'valor_produto' => $request->valor_unitario[$i],
                'quantidade' => $request->quantidade[$i],
                'unidade_medida' => $request->unidade_medida[$i],
            ];
        }
        //chama a função do repository de itens que salva no banco
        $ProdutosCompraRepository = new ProdutoCompraRepository();
        $ProdutosCompraRepository->create($itensProduto, $fk_tab_solicitacao_compra_id->id_solicitacao_compra);
    }


        return redirect('/compras');

    }
    
}
