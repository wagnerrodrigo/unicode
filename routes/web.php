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
use App\Http\Controllers\ContaBancariaController;
use App\Http\Controllers\ContaPagarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\InstituicaoBancariaController;
use Illuminate\Support\Facades\Route;

//rotas públicas
Route::get('forgot-password{error?}', [LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot');

Route::get('/login{error?}', [LoginController::class, 'index'])->name('autenticacao');
Route::post('/login', [LoginController::class, 'authentication'])->name('autenticacao');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/home', [PainelController::class, 'index'])->name('painel');
Route::get('/nota', [NotaFiscalController::class, 'index'])->name('nota');

Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');

//rotas Fornecedor
Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
Route::get('/fornecedores/{id}', [FornecedorController::class, 'show'])->name('show-fornecedor');
Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores');
Route::post('/fornecedores/editar/{id}', [FornecedorController::class, 'edit'])->name('edit-fornecedores');
Route::post('/fornecedores/delete/{id}', [FornecedorController::class, 'destroy'])->name('destroy-fornecedores');

//rotas Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::get('/cadastro-usuarios', [UsuarioController::class, 'cadastro'])->name('cadastro-usuarios');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('edit-usuarios');

//rotas Despesas
Route::get('/despesas', [DespesaController::class, 'index'])->name('despesas');
Route::get('/despesas/adicionar', [DespesaController::class, 'addDespesa'])->name('add-despesas');
Route::post('/despesas/adicionar', [DespesaController::class, 'store'])->name('add-despesas');

//rotas Lançamentos
Route::get('/lancamentos', [LancamentoController::class, 'index'])->name('lancamentos');

//rotas Receitas
Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas');

//rotas Movimentos
Route::get('/movimentos', [MovimentoController::class, 'index'])->name('movimentos');

//rotas Contratos
Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos');

//rotas Serviço
Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos');
Route::get('/servicos/{id}', [ServicoController::class, 'show'])->name('list-servico');
Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos-create');
Route::post('/servicos/editar/{id}', [ServicoController::class, 'edit']);
Route::post('/servicos/delete/{id}', [ServicoController::class, 'destroy'])->name('servicos-destroy');

//rotas Produto
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
Route::get('/produtos/{id}',[ProdutoController::class, 'show'])->name('lista-produto');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos-create');
Route::post('/produtos/editar/{id}',[ProdutoController::class, 'edit']);
Route::post('/produtos/delete/{id}',[ProdutoController::class, 'destroy']);


//rotas Centro de custo
Route::get('/centro-custos', [CentroCusto::class, 'index'])->name('centro-custos');

// rotas Plano de contas
Route::get('/plano-contas', [PlanoContaController::class, 'index'])->name('plano-contas');
Route::get('/cadastro-planos-contas', [PlanoContaController::class, 'cadastro'])->name('cadastro-planos-contas');

// rotas Contas Bancárias
Route::get('/contas-bancarias', [ContaBancariaController::class, 'index'])->name('contas-bancarias');
Route::get('/contas-bancarias/{id}', [ContaBancariaController::class, 'show'])->name('contas-bancarias-show');
Route::post('/contas-bancarias', [ContaBancariaController::class, 'store']);
Route::post('/contas-bancarias/editar/{id}', [ContaBancariaController::class, 'edit']);
Route::post('/contas-bancarias/delete/{id}', [ContaBancariaController::class, 'destroy']);

//rotas Instituições Bancárias
Route::get('/bancos', [InstituicaoBancariaController::class, 'index'])->name('instituicoes-bancarias');

// rotas de Contas a pagar 
Route::get('/contas', [ContaPagarController::class, 'index'])->name('contas-pagar');

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
