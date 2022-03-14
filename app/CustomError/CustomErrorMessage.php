<?php

namespace App\CustomError;

class CustomErrorMessage
{
    const MSG1 = 'O campo senha é obrigatório';
    const MSG2 = 'O campo email é obrigatório';

    const ERROR_FORNECEDOR = 'Fornecedor não encontrado';
    const ERROR_PAGAMENTO = 'Pagamento não encontrado';
    const ERROR_ENDERECO = 'Endereço não encontrado';
    const ERROR_DESPESA = 'Despesa não encontrada';
    const ERROR_LANCAMENTO = 'Lançamento não encontrado';

    const ERROR_LIST_FORNECEDOR = 'Não foi possível listar os fornecedores';
    const ERROR_LIST_PAGAMENTO = 'Não foi possível listar os pagamentos';
    const ERROR_LIST_DESPESA = 'Não foi possível listar as despesas';
    const ERROR_LIST_LANCAMENTO = 'Não foi possível listar os lançamentos';
}
