<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BIController;
use App\Http\Controllers\CentroCusto;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ContabilController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\GestaoPessoasController;
use App\Http\Controllers\JuridicoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

//rotas públicas
Route::get('forgot-password{error?}', [LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot');

Route::get('/login{error?}', [LoginController::class, 'index'])->name('autenticacao');
Route::post('/login', [LoginController::class, 'authentication'])->name('autenticacao');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
//Route::get('/', [function(){return view('page-login');}]);

Route::get('/home', [PainelController::class, 'index'])->name('painel');
Route::get('/nota', [NotaFiscalController::class, 'index'])->name('nota');

Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');

//rotas Fornecedor
Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores');

//rotas Serviço
Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos');
Route::get('/servicos/listas', [ServicoController::class, 'list'])->name('lista-servico');

//rotas Produto
Route::get('/produtos',[ProdutoController::class, 'index'])->name('produtos');
Route::get('/produtos/listas',[ProdutoController::class, 'list'])->name('lista-produto');

//rotas Centro de custo
Route::get('/centros-custos',[CentroCusto::class,'index'])->name('centros-custos');

//rotas com autenticação
Route::prefix('/painel')->group(function () {
    //Route::middleware('autenticacaoMiddleware')->get('/home', [PainelController::class, 'index'])->name('painel');

    Route::middleware('autenticacaoMiddleware')->get('/logout', [LoginController::class, 'logout'])->name('logout');
    //Route::middleware('autenticacaoMiddleware')->get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::middleware('autenticacaoMiddleware')->get('/bi', [BIController::class, 'index'])->name('bi');
    Route::middleware('autenticacaoMiddleware')->get('/compliance', [ComplianceController::class, 'index'])->name('compliance');
    Route::middleware('autenticacaoMiddleware')->get('/compras', [ComprasController::class, 'index'])->name('compras');
    Route::middleware('autenticacaoMiddleware')->get('/contabil', [ContabilController::class, 'index'])->name('contabil');
    // Route::middleware('autenticacaoMiddleware')->get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');
    Route::middleware('autenticacaoMiddleware')->get('/gestao-de-pessoas', [GestaoPessoasController::class, 'index'])->name('rh');
    Route::middleware('autenticacaoMiddleware')->get('/juridico', [JuridicoController::class, 'index'])->name('juridico');
    Route::middleware('autenticacaoMiddleware')->get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio');
    Route::middleware('autenticacaoMiddleware')->get('/contratos', [GestaoDeContratosController::class, 'index'])->name('contratos');
});
