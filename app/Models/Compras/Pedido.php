<?php

namespace App\Models\Compras;

use App\Models\Produto;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\User;

class Pedido extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'filial',
        'departamento',
        'categoria',
        'centro_custo',
        'produto',
        'quantidade',
        'complemento',
        'data_pedido',
        'fim_pedido'
    ];

    // public function produtos(){
    //     return $this->hasMany(Produto::class, 'fk_tab_solicitacao_compra_id');
    // }

    static function salvarPedido($purchase)
    {
        DB::insert("INSERT INTO intranet.tab_solicitacao_compra
        (fk_tab_empregado_id,
         fk_tab_cargo_funcional_id,
         fk_tab_empresa_id,
         fk_tab_carteira_id,
         fk_tab_status_pedido_id,
         complemento_solicitacao,
         data_pedido,
         fim_pedido)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ", [
             $purchase->fk_tab_empregado_id,
             $purchase->fk_tab_cargo_funcional_id,
             $purchase->fk_tab_empresa_id,
             $purchase->fk_tab_carteira_id,
             $purchase->fk_tab_status_pedido_id,
             $purchase->complemento_solicitacao,
             $purchase->data_pedido,
             $purchase->fim_pedido
        ]);
        echo "<script> alert('Pedido criado com sucesso!!') </script>";
    }

    static function findByTimeStamp($timestamp)
    {
        $retorno = DB::select("SELECT id_solicitacao_compra FROM intranet.tab_solicitacao_compra WHERE data_pedido = ?", [$timestamp]);
        if($retorno){
            return $retorno[0];
        }
        return $retorno;
       
    }


    static function selectAll($results, $nome = null, $titulo = null, $setor = null, $fim_data = null, $status = null)
    {
        //ID  Solicitante	Titulo	Setor	Data	Status
        $query = DB::table('intranet.tab_solicitacao_compra')
            ->select( 
                'tab_solicitacao_compra.id_solicitacao_compra',
                'tab_solicitacao_compra.data_pedido',   //Data da Solicitação
                'tab_solicitacao_compra.complemento_solicitacao',   //Complemento da Solicitação
                'tab_empregado.nome_empregado',  // nome do Solicitante
                'tab_empregado.nu_cpf_cnpj',  //numero do CPF/CNPJ do Solicitante
                'tab_status_pedido.status_atual',
                'tab_cargo_funcional.de_cargo_funcional',
                'tab_produto_solicitado.fk_tab_solicitacao_compra_id',
                'tab_produto_solicitado.quantidade',
                'tab_produto_solicitado.unidade_medida',
                'tab_produto.de_produto',
                'tab_tipo_produto.de_tipo_produto',
                'tab_empresa.de_empresa'
            )->join(
                'intranet.tab_empregado',
                'intranet.tab_empregado.id_empregado',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_empregado_id'
            )->join(
                'intranet.tab_status_pedido',
                'intranet.tab_status_pedido.id_status_pedido',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_status_pedido_id'
            )->join(
                'intranet.tab_cargo_funcional',
                'intranet.tab_cargo_funcional.id_cargo_funcional',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_cargo_funcional_id'
            )->join(
                'intranet.tab_produto_solicitado',
                'intranet.tab_produto_solicitado.fk_tab_solicitacao_compra_id',
                '=',
                'intranet.tab_solicitacao_compra.id_solicitacao_compra'
            )->join(
                'intranet.tab_produto',
                'intranet.tab_produto.id_produto',
                '=',
                'intranet.tab_produto_solicitado.fk_tab_produto_id'
            )->join(
                'intranet.tab_tipo_produto',
                'intranet.tab_tipo_produto.id_tipo_produto',
                '=',
                'intranet.tab_produto.fk_tab_tipo_produto_id'
            )->join(
                'intranet.tab_empresa',
                'intranet.tab_empresa.id_empresa',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_empresa_id'
            )

            ->distinct('id_solicitacao_compra')

            ->where('intranet.tab_solicitacao_compra.fim_pedido', '=', null);
           
        if ($nome && $titulo && $setor || $fim_data && $status) {
            $pedido = $query
                ->where("intranet.tab_solicitacao_compra.fk_tab_status_pedido_id", '=', "$status")
                ->orderBy('id_solicitacao_compra', 'desc')->paginate($results);
        } 
        else {
            $pedido = $query
                ->orderBy('id_solicitacao_compra', 'desc')
                ->paginate($results);
        }
         //dd($pedido);
        return $pedido;
    }


    
    static function findOne($id)
    {
        //ID  Solicitante	Titulo	Setor	Data	Status
        $query = DB::table('intranet.tab_solicitacao_compra')
            ->select( 
                'tab_solicitacao_compra.id_solicitacao_compra',
                'tab_solicitacao_compra.data_pedido',   //Data da Solicitação
                'tab_solicitacao_compra.complemento_solicitacao',   //Complemento da Solicitação
                'tab_empregado.nome_empregado',  // nome do Solicitante
                'tab_empregado.nu_cpf_cnpj',  //numero do CPF/CNPJ do Solicitante
                'tab_status_pedido.status_atual',
                'tab_cargo_funcional.de_cargo_funcional',
                'tab_produto_solicitado.fk_tab_solicitacao_compra_id',
                'tab_produto_solicitado.quantidade',
                'tab_produto_solicitado.unidade_medida',
                'tab_produto.de_produto',
                'tab_tipo_produto.de_tipo_produto',
                'tab_empresa.de_empresa'
            )->join(
                'intranet.tab_empregado',
                'intranet.tab_empregado.id_empregado',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_empregado_id'
            )->join(
                'intranet.tab_status_pedido',
                'intranet.tab_status_pedido.id_status_pedido',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_status_pedido_id'
            )->join(
                'intranet.tab_cargo_funcional',
                'intranet.tab_cargo_funcional.id_cargo_funcional',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_cargo_funcional_id'
            )->join(
                'intranet.tab_produto_solicitado',
                'intranet.tab_produto_solicitado.fk_tab_solicitacao_compra_id',
                '=',
                'intranet.tab_solicitacao_compra.id_solicitacao_compra'
            )->join(
                'intranet.tab_produto',
                'intranet.tab_produto.id_produto',
                '=',
                'intranet.tab_produto_solicitado.fk_tab_produto_id'
            )->join(
                'intranet.tab_tipo_produto',
                'intranet.tab_tipo_produto.id_tipo_produto',
                '=',
                'intranet.tab_produto.fk_tab_tipo_produto_id'
            )->join(
                'intranet.tab_empresa',
                'intranet.tab_empresa.id_empresa',
                '=',
                'intranet.tab_solicitacao_compra.fk_tab_empresa_id'
            )

            ->distinct('id_solicitacao_compra')
            
            ->where('intranet.tab_solicitacao_compra.fim_pedido', '=', null);

            $pedido = $query
                ->orderBy('id_solicitacao_compra', 'desc')
                ->paginate($id);

        return $pedido;
    }


}