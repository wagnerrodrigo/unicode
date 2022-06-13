@extends('layouts.templates.template')
@section('title', 'Extrato')
@section('content')

<form action="" method="" id="form_paginacao_extrato">
    <input type="hidden" id="page_extrato" name="page" value="0">
</form>

<form action="" id="form_paginacao_lancamento">
    <input type="hidden" id="page_lancamento" name="page" value="0">
</form>
<div class="col-xl-12">
    <div class="card">
        <div class="card-lancamentos">

        </div>
    </div>
    <div class="card">
        <div class="card-extratos">

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        loadTableExtrato(0);
        loadTableLancamentos(0);
    });

    $(document).on('click', '#pagination_extratos a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadTableExtrato(page);
    });

    $(document).on('click', '#pagination_lancamentos a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('/parcelas?page=')[1];
        console.log(page);
        loadTableLancamentos(page);

    });

    function loadTableExtrato(page) {
        $('#page_extrato').val(page);
        var dados = $('#form_paginacao_extrato').serialize();
        $.ajax({
            url: "{{ route('extrato2') }}",
            type: 'GET',
            data: dados,
        }).done(function(data) {
            $('.card-extratos').html(data);
        });
    }

    function loadTableLancamentos(page) {
        $('#page_lancamento').val(page);
        var dados = $('#form_paginacao_lancamento').serialize();
        $.ajax({
            url: "{{ route('paginate-lancamento') }}",
            type: 'GET',
            data: dados,
        }).done(function(data) {
            $('.card-lancamentos').html(data);
        });
    }
</script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="{{ asset('assets/js/custom-js/extrato.js') }}"></script> -->
<script>
    function conciliacao() {
        if (lancamentos.length == 0) {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum lançamento",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (extratos.length == 0) {
            swal.fire({
                title: "Atenção",
                text: "Você não selecionou nenhum extrato",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (valorDespesa + valorExtrato != 0) {
            swal.fire({
                title: "Atenção",
                text: "O valor da despesa é diferente do valor do(s) extrato(s)",
                icon: "warning",
                showConfirmButton: true,
            });
        } else if (lancamentos[0].conta_bancaria != extratos[0].conta_bancaria) {
            swal.fire({
                title: "Atenção",
                text: "As contas bancárias dos lançamentos e extratos selecionados não são iguais",
                icon: "warning",
                showConfirmButton: true,
            });
        } else {
            $.ajax({
                type: "POST",
                url: `/conciliacao`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    lancamentos,
                    extratos
                },
                dataType: "json",
                success: function(response) {
                    swal({
                        title: "Sucesso",
                        text: "Conciliação realizada com sucesso",
                        icon: "success",
                    }).then(function() {
                        window.location.href = "/extrato";
                    });
                },
                fail: function(response) {
                    swal({
                        title: "Atenção",
                        text: "Erro ao realizar a conciliação",
                        icon: "warning",
                        button: "Ok",
                    });
                }
            });
        }
    };

    //função para validar os checkboxes
    function deleteLancamento(id) {
        Swal.fire({
            title: 'Atenção!',
            text: `Deseja Realmente Excluir o Lançamento ${id}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#820AD1',
            cancelButtonColor: '#D1611F',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `/lancamentos/delete/${id}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id_lancamento: id,
                    },
                    success: function(data) {
                        if (data) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Deletado',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Erro ao deletar',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    },
                });
            }
        });
    }

    function editLancamento(id) {
        var dt_pagamento = $(`#data_efetivo_pagamento_${id}`).text();
        var dt_pagamento_formatada = FormataStringData(dt_pagamento);

        Swal.fire({
            title: '<h3>EDITAR DATA DE PAGAMENTO</h3>',
            html: ', ' +
                `<form action="/lancamentos/edit/${id}" method="post">` +
                '<div class="input-group mx-auto" style="width: 250px">' +
                `<input type="date" class="form-control" name="payment_date" value="${dt_pagamento_formatada}">` +
                `<input type="hidden" name="_token" value="{{ csrf_token() }}">` +
                '</div>' +
                `<button type="submit" class="btn btn-primary mt-5">Salvar</button>` +
                `</form>`,
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
        })
    }

    function FormataStringData(data) {
        var dia = data.split("/")[0];
        var mes = data.split("/")[1];
        var ano = data.split("/")[2];

        return ano + '-' + ("0" + mes).slice(-2) + '-' + ("0" + dia).slice(-2);
        // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
    }
</script>
@endsection