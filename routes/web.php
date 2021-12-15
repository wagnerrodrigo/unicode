<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BIController;
use App\Http\Controllers\CentroCustos;
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
use App\Http\Controllers\ApiViaCepController;
use App\Http\Controllers\InstituicaoFinanceiraController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CentroCustosController;
use App\Http\Controllers\ClassificacaoContabilController;
use App\Models\ClassificacaoContabil;
use App\Http\Controllers\ConciliacaoController;
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

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/home', [PainelController::class, 'index'])->name('painel');
Route::get('/nota', [NotaFiscalController::class, 'index'])->name('nota');

Route::get('/financeiro', [FinanceiroController::class, 'index'])->name('financeiro');

//rotas Fornecedor
Route::get('/fornecedores/adicionar', [FornecedorController::class, 'formFornecedores'])->name('add-fornecedor');
Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
Route::get('/fornecedores/{id}', [FornecedorController::class, 'show'])->name('show-fornecedor');
Route::get('/fornecedores/cnpj_cpf/{nu_cpf_cnpj}', [FornecedorController::class, 'showCnpjCpf']);
Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores');
Route::get('/fornecedores/cnpj/{cnpj}', [FornecedorController::class, 'showByCnpj']);
Route::get('/fornecedores/nome/{name}', [FornecedorController::class, 'showByName']);
Route::post('/fornecedores/editar/{id}', [FornecedorController::class, 'edit'])->name('edit-fornecedores');
Route::post('/fornecedores/delete/{id}', [FornecedorController::class, 'destroy'])->name('destroy-fornecedores');

// rotas Empregados
Route::get('/empregados/cpf/{nu_cpf_cnpj}', [EmpregadoController::class, 'showCpf']);

//rotas Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::get('/cadastro-usuarios', [UsuarioController::class, 'cadastro'])->name('cadastro-usuarios');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('edit-usuarios');

//rotas Despesas
Route::get('/despesas', [DespesaController::class, 'index'])->name('despesas');
Route::post('/despesas', [DespesaController::class, 'store']);
Route::get('/despesas/adicionar', [DespesaController::class, 'formDespesa'])->name('adicionar-despesa');
Route::get('/despesas/{id}', [DespesaController::class, 'show']);

//rotas condicao pagamento
Route::get('/condicao_pagamento', [CondicaoPagamentoController::class, 'index'])->name('condicao-pagamento');
//rotas Despesas
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas');
Route::get('/empresas/adicionar', [EmpresaController::class, 'formEmpresa'])->name('adicionar-empresa');
Route::post('/empresas/adicionar', [EmpresaController::class, 'store'])->name('add-empresas');
Route::get('/empresas/{id}', [EmpresaController::class, 'show']);
Route::get('/empresas/cnpj/{cnpj}', [EmpresaController::class, 'showByCnpj']);
Route::get('/empresas/nome/{name}', [EmpresaController::class, 'showByName']);


//Centro de custo Empresa rotas
Route::get('/centroCustoEmpresa/{id}', [CentroCustosController::class, 'showById']);
Route::get('/centroCustoEmpresa/nome/{nome}', [CentroCustosController::class, 'showByName']);

//rotas Lançamentos
Route::get('/lancamentos', [LancamentoController::class, 'index'])->name('lancamentos');
Route::get('/lancamentos/paginate', [LancamentoController::class, 'paginate']);
Route::get('/lancamentos/{id}', [LancamentoController::class, 'show'])->name('lancamentos-show');
Route::get('/lancamentos/provisionamento/{id}', [LancamentoController::class, 'provisionamento'])->name('add-lancamento-provisionamento');

Route::get('/lancamentos/info-conta/{info}', [LancamentoController::class, 'showDataInsBanc']);
Route::get('/lancamentos/info-agencia/{id_conta}', [LancamentoController::class, 'showDataAgency']);
Route::get('/lancamentos/info-contaBancaria/{id_agencia}', [LancamentoController::class, 'showBankAccount']);
Route::get('/lancamentos/info-fornecedor-empregado/{id_despesa}', [LancamentoController::class, 'showProvidedEmployee']);

//rotas Receitas
Route::get('/receitas', [ReceitaController::class, 'index'])->name('receitas');

//rotas Movimentos
Route::get('/movimentos', [MovimentoController::class, 'index'])->name('movimentos');

//rotas Contratos
Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos');

//rotas Serviço
Route::get('/servicos',              [ServicoController::class, 'index'])->name('servicos');
Route::get('/servicos/{id}',         [ServicoController::class, 'show'])->name('list-servico');
Route::post('/servicos',             [ServicoController::class, 'store']);
Route::post('/servicos/editar/{id}', [ServicoController::class, 'edit']);
Route::post('/servicos/delete/{id}', [ServicoController::class, 'destroy']);
Route::get('/servico/classificacao', [ServicoController::class, 'showClassificacaoServico']);
Route::get('/servico/classificacao/{id}', [ServicoController::class, 'showClassificacaoServicoId']);


//rotas Produto
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('lista-produtos');
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::post('/produtos/editar/{id}', [ProdutoController::class, 'edit']);
Route::post('/produtos/delete/{id}', [ProdutoController::class, 'destroy']);
Route::get('/produto/classificacao', [ProdutoController::class, 'showClassificacaoProduto']);
Route::get('/produto/classificacao/{id}', [ProdutoController::class, 'showClassificacaoProdutoId']);

//rotas Centro de custo
Route::get('/centro-custos', [CentroCustos::class, 'index'])->name('centro-custos');
Route::get('/centro-custos/{id}', [CentroCustos::class, 'show']);
Route::post('/centro-custos', [CentroCustos::class, 'store']);
Route::post('/centro-custos/editar/{id}', [CentroCustos::class, 'edit']);
Route::post('/centro-custos/delete/{id}', [CentroCustos::class, 'destroy']);

// rotas Plano de contas
Route::get('/plano-contas', [PlanoContaController::class, 'index'])->name('plano-contas');
Route::get('/cadastro-planos-contas', [PlanoContaController::class, 'cadastro'])->name('cadastro-planos-contas');

//rotas para classificacao contabil
Route::get('/classificacao-contabil', [ClassificacaoContabilController::class, 'index'])->name('classificacao-contabil');
Route::get('/classificacao-contabil/{id}', [ClassificacaoContabilController::class, 'showPlanoContas'])->name('show-plano-contas');

// rotas Contas Bancárias
Route::get('/contas-bancarias', [ContaBancariaController::class, 'index'])->name('contas-bancarias');
Route::get('/contas-bancarias/{id}', [ContaBancariaController::class, 'show'])->name('contas-bancarias-show');
Route::post('/contas-bancarias', [ContaBancariaController::class, 'store']);
Route::post('/contas-bancarias/editar/{id}', [ContaBancariaController::class, 'edit']);
Route::post('/contas-bancarias/delete/{id}', [ContaBancariaController::class, 'destroy']);
Route::get('/contas-bancarias/fornecedor/{id}', [ContaBancariaController::class, 'showByFornecedor']);


Route::get('/pix/fornecedor/{id}', [PixController::class, 'showByFornecedor'])->name('pix');

//rotas Instituições Bancárias
Route::get('/instituicoes-financeira', [InstituicaoFinanceiraController::class, 'index'])->name('instituicoes-financeira');
Route::get('/instituicoes-financeira/{id}', [InstituicaoFinanceiraController::class, 'show'])->name('instituicoes-financeira-show');
Route::post('/instituicoes-financeira', [InstituicaoFinanceiraController::class, 'store']);
Route::post('/instituicoes-financeira/editar/{id}', [InstituicaoFinanceiraController::class, 'edit']);
Route::post('/instituicoes-financeira/delete/{id}', [InstituicaoFinanceiraController::class, 'destroy']);

// rotas de Contas a pagar
Route::get('/contas', [ContaPagarController::class, 'index'])->name('contas-pagar');

Route::post('/enderecos', [EnderecoController::class, 'store']);
Route::get('/enderecos', [EnderecoController::class, 'index']);
Route::get('/enderecos/empresas', [EnderecoController::class, 'selectEmpresa']);
Route::get('/enderecos/adicionar', [EnderecoController::class, 'formEndereco']);
Route::get('/enderecos/{id}', [EnderecoController::class, 'show']);
//Route::post('/enderecos/adicionar', [EnderecoController::class, 'store']);

// rotas de pagamentos
Route::get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamentos');

// rotas de extrato
Route::get('/extrato', [ExtratoController::class, 'index'])->name('extrato');
Route::get('/extrato/id', [ExtratoController::class, 'show'])->name('show-extrato');
Route::get('/extrato/empresa', [ExtratoController::class, 'showCompany']);
Route::get('/extrato/info/{id}', [ExtratoController::class, 'showInfo']);

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


Route::post('/cep', [ApiViaCepController::class, 'buscaCep']);
Route::get('/cep', [FornecedorController::class, 'testeCep']);
