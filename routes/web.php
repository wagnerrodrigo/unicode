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
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\PlanoContaController;
use App\Http\Controllers\CantaBancariaController;
use App\Http\Controllers\ContaPagarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ContratoController;
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
Route::get('/cadastro-fornecedores', [FornecedorController::class, 'cadastro'])->name('cadastro-fornecedores');
Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores');
Route::get('/fornecedores/{id}', [FornecedorController::class, 'show'])->name('edit-fornecedores');

//rotas Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::get('/cadastro-usuarios', [UsuarioController::class, 'cadastro'])->name('cadastro-usuarios');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('edit-usuarios');

//rotas Despesas
Route::get('/despesas', [DespesaController::class, 'index'])->name('despesas');

//rotas Contratos
Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos');


//rotas Serviço
Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos');
Route::get('/servicos/listas', [ServicoController::class, 'list'])->name('lista-servico');

//rotas Produto
Route::get('/produtos',[ProdutoController::class, 'index'])->name('produtos');
Route::get('/produtos/listas',[ProdutoController::class, 'list'])->name('lista-produto');

//rotas Centro de custo
Route::get('/centros-custos',[CentroCusto::class,'index'])->name('centros-custos');

// rotas Plano de contas
Route::get('/planos-contas',[PlanoContaController::class,'index'])->name('planos-contas');
Route::get('/cadastro-planos-contas',[PlanoContaController::class,'cadastro'])->name('cadastro-planos-contas');

// rotas Contas Bancárias
Route::get('/contas-bancarias',[CantaBancariaController::class,'index'])->name('contas-bancarias');
Route::get('/cadastro-contas-bancarias',[CantaBancariaController::class,'cadastro'])->name('cadastro-contas-bancarias');

// rotas de Contas a pagar 
Route::get('contas-pagar ',[ContaPagarController::class,'index'])->name('/contas-pagar');

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
