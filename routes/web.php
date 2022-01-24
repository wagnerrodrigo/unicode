<?php

use App\Http\Controllers\CentroCustos;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PlanoContaController;
use App\Http\Controllers\ContaBancariaController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ApiViaCepController;
use App\Http\Controllers\InstituicaoFinanceiraController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CentroCustosController;
use App\Http\Controllers\ClassificacaoContabilController;
use App\Http\Controllers\EmpregadoController;
use App\Http\Controllers\CondicaoPagamentoController;
use App\Http\Controllers\ExtratoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PixController;
use Illuminate\Support\Facades\Route;

//rotas públicas
Route::get('forgot-password{error?}', [LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot');

Route::get('/login{error?}', [LoginController::class, 'index'])->name('autenticacao');
Route::post('/login', [LoginController::class, 'authentication'])->name('autenticacao');

Route::middleware('autenticacaoMiddleware')->group(function () {
    Route::get('/home', [PainelController::class, 'index'])->name('painel');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');
});

Route::get('/teste', [TesteController::class, 'all'])->name('teste');

//rotas extratos
Route::middleware('autenticacaoMiddleware')->prefix('/extrato')->group(function () {
    Route::get('/', [ExtratoController::class, 'index'])->name('extrato');
    Route::get('/lancamento/{id}', [ExtratoController::class, 'show']);
    Route::get('/empresa', [ExtratoController::class, 'showCompany']);
    Route::get('/pesquisa/{dt_inicio}/{dt_fim}', [ExtratoController::class, 'showPeriodDate']);

});

//rotas Fornecedores
Route::middleware('autenticacaoMiddleware')->prefix('/fornecedores')->group(function () {
    Route::get('/adicionar', [FornecedorController::class, 'formFornecedores'])->name('add-fornecedor');
    Route::get('/', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::get('/{id}', [FornecedorController::class, 'show'])->name('show-fornecedor');
    Route::get('/cnpj_cpf/{nu_cpf_cnpj}', [FornecedorController::class, 'showCnpjCpf']);
    Route::post('/', [FornecedorController::class, 'store'])->name('fornecedores');
    Route::get('/cnpj/{cnpj}', [FornecedorController::class, 'showByCnpj']);
    Route::get('/nome/{name}', [FornecedorController::class, 'showByName']);
    Route::post('/editar/{id}', [FornecedorController::class, 'edit'])->name('edit-fornecedores');
    Route::post('/delete/{id}', [FornecedorController::class, 'destroy'])->name('destroy-fornecedores');
});


// rotas Empregados
Route::middleware('autenticacaoMiddleware')->prefix('/empregados')->group(function () {
    Route::get('/cpf/{nu_cpf_cnpj}', [EmpregadoController::class, 'showCpf']);
});

Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');

//rotas Despesas
Route::middleware('autenticacaoMiddleware')->prefix('/despesas')->group(function () {
    Route::get('/', [DespesaController::class, 'index'])->name('despesas');
    Route::post('/', [DespesaController::class, 'store']);
    Route::get('/adicionar', [DespesaController::class, 'formDespesa'])->name('adicionar-despesa');
    Route::get('/{id}', [DespesaController::class, 'show']);
});

//rotas condicao pagamento
Route::middleware('autenticacaoMiddleware')->prefix('/condicao_pagamento')->group(function () {
    Route::get('/', [CondicaoPagamentoController::class, 'index'])->name('condicao-pagamento');
});
//rotas Despesas

Route::middleware('autenticacaoMiddleware')->prefix('/empresas')->group(function () {
    Route::get('/', [EmpresaController::class, 'index'])->name('empresas');
    Route::get('/adicionar', [EmpresaController::class, 'formEmpresa'])->name('adicionar-empresa');
    Route::post('/adicionar', [EmpresaController::class, 'store'])->name('add-empresas');
    Route::get('/{id}', [EmpresaController::class, 'show']);
    Route::get('/cnpj/{cnpj}', [EmpresaController::class, 'showByCnpj']);
    Route::get('/nome/{name}', [EmpresaController::class, 'showByName']);
});


//Centro de custo Empresa rotas
Route::middleware('autenticacaoMiddleware')->prefix('/centroCustoEmpresa')->group(function () {
    Route::get('/{id}', [CentroCustosController::class, 'showById']);
    Route::get('/nome/{nome}', [CentroCustosController::class, 'showByName']);
});

//rotas Lançamentos
Route::get('/lancamentos', [LancamentoController::class, 'index'])->name('lancamentos');
Route::middleware('autenticacaoMiddleware')->prefix('/lancamentos')->group(function () {


    Route::get('/paginate', [LancamentoController::class, 'paginate']);
    Route::get('/{id}', [LancamentoController::class, 'show'])->name('lancamentos-show');
    Route::get('/provisionamento/{id}', [LancamentoController::class, 'provisionamento'])->name('lancamento-provisionamento');
    Route::post('/adicionar', [LancamentoController::class, 'store']);

    Route::get('/info-conta/{info}', [LancamentoController::class, 'showDataInsBanc']);
    Route::get('/info-agencia/{id_conta}', [LancamentoController::class, 'showDataAgency']);
    Route::get('info-contaBancaria/{id_agencia}', [LancamentoController::class, 'showBankAccount']);
    Route::get('/info-fornecedor-empregado/{id_despesa}', [LancamentoController::class, 'showProvidedEmployee']);
    Route::get('/filtro-periodo/{info_data}/{info_dataFim}', [LancamentoController::class, 'showPeriodDate']);

    Route::get('/filtro-empresaContas/{id}', [LancamentoController::class, 'showCompanyAccountInformation']);
    Route::get('/filtro-status/{id_status}', [LancamentoController::class, 'showStatus']);
    Route::get('/pesquisa/atributos', [LancamentoController::class, 'showBydateAndstatus']);
});


//rotas Produto
Route::prefix('/produto')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name('produtos');
    Route::get('show/classificacao', [ProdutoController::class, 'showClassificacaoProduto']);
    Route::get('/{id}', [ProdutoController::class, 'show'])->name('lista-produtos');
    Route::post('/', [ProdutoController::class, 'store']);
    Route::post('/editar/{id}', [ProdutoController::class, 'edit']);
    Route::post('/delete/{id}', [ProdutoController::class, 'destroy']);
    Route::get('/classificacao/{id}', [ProdutoController::class, 'showClassificacaoProdutoId']);
});

//rotas Centro de custo
Route::middleware('autenticacaoMiddleware')->prefix('/centro-custos')->group(function () {
    Route::get('/', [CentroCustos::class, 'index'])->name('centro-custos');
    Route::get('/{id}', [CentroCustos::class, 'show']);
    Route::post('/', [CentroCustos::class, 'store']);
    Route::post('/editar/{id}', [CentroCustos::class, 'edit']);
    Route::post('/delete/{id}', [CentroCustos::class, 'destroy']);
});

// rotas Plano de contas
Route::get('/plano-contas', [PlanoContaController::class, 'index'])->name('plano-contas');
Route::get('/cadastro-planos-contas', [PlanoContaController::class, 'cadastro'])->name('cadastro-planos-contas');

//rotas para classificacao contabil
Route::middleware('autenticacaoMiddleware')->prefix('/classificacao-contabil')->group(function () {
    Route::get('/', [ClassificacaoContabilController::class, 'index'])->name('classificacao-contabil');
    Route::get('/{id}', [ClassificacaoContabilController::class, 'showPlanoContas'])->name('show-plano-contas');
});
// rotas Contas Bancárias
Route::middleware('autenticacaoMiddleware')->prefix('/contas-bancarias')->group(function () {
    Route::post('/store', [ContaBancariaController::class, 'storeWithJSON']);
    Route::get('/', [ContaBancariaController::class, 'index'])->name('contas-bancarias');
    Route::get('/{id}/{tipo_despesa}', [ContaBancariaController::class, 'showByIdFornecedorEmpregado']);
    Route::get('/{id}', [ContaBancariaController::class, 'show'])->name('contas-bancarias-show');
    Route::post('/', [ContaBancariaController::class, 'store']);
    Route::post('/editar/{id}', [ContaBancariaController::class, 'edit']);
    Route::post('/delete/{id}', [ContaBancariaController::class, 'destroy']);
    Route::get('/fornecedor/{id}', [ContaBancariaController::class, 'showByFornecedor']);
});

Route::middleware('autenticacaoMiddleware')->get('/pix/fornecedor/{id}', [PixController::class, 'showByFornecedor'])->name('pix');

//rotas Instituições Bancárias
Route::middleware('autenticacaoMiddleware')->prefix('/instituicoes-financeira')->group(function () {
    Route::get('/', [InstituicaoFinanceiraController::class, 'index'])->name('instituicoes-financeira');
    Route::get('/{id}', [InstituicaoFinanceiraController::class, 'show'])->name('instituicoes-financeira-show');
    Route::post('/', [InstituicaoFinanceiraController::class, 'store']);
    Route::post('/editar/{id}', [InstituicaoFinanceiraController::class, 'edit']);
    Route::post('/delete/{id}', [InstituicaoFinanceiraController::class, 'destroy']);
});

Route::middleware('autenticacaoMiddleware')->prefix('/enderecos')->group(function () {
    Route::post('/', [EnderecoController::class, 'store']);
    Route::get('/', [EnderecoController::class, 'index']);
    Route::get('/empresas', [EnderecoController::class, 'selectEmpresa']);
    Route::get('/adicionar', [EnderecoController::class, 'formEndereco']);
    Route::get('/{id}', [EnderecoController::class, 'show']);
    //Route::post('/adicionar', [EnderecoController::class, 'store']);
});

// rotas de pagamentos
Route::middleware('autenticacaoMiddleware')->get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamentos');

Route::middleware('autenticacaoMiddleware')->prefix('/cep')->group(function () {
    Route::post('/', [ApiViaCepController::class, 'buscaCep']);
    Route::get('/', [FornecedorController::class, 'testeCep']);
});
