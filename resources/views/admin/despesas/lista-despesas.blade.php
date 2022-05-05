@extends('layouts.templates.template')
@section('title', 'Lista Despesas')
@section('content')

<div id="main" style="margin-top: 5px;">
    <div class="main-content container-fluid">
        <div class="card">
            <div class="card-header">
                <h1>DESPESAS</h1>
                <a href="/despesas/adicionar" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> NOVA DESPESA
                </a>
            </div>

            <div class="card-body">
                <!-- Form de filtro por status -->
                <form name="form_status">
                    <div class="d-flex flex-column justify-content-around">
                        <div class="d-flex flex-row justify-content-around">
                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">RESULTADOS</label>
                                <select class="form-select" id="inputStatus" name="results">
                                    <option name="results" selected value="10">10</option>
                                    <option name="results" value="15">15</option>
                                    <option name="results" value="20">20</option>
                                </select>
                            </div>

                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">STATUS</label>
                                <select class="form-select" id="inputStatus" name="status">
                                    <option value=""></option>
                                    <option value="6">A PAGAR</option>
                                    <option value="4">EM ATRASO</option>
                                    <option value="5">MIGRAÇÃO</option>
                                    <option value="2">PAGO</option>
                                    <option value="1">PROVISIONADO</option>
                                </select>
                            </div>

                            <div class="input-group mb-3" style="width: 250px">
                                <label class="input-group-text" for="inputStatus">FILIAL</label>
                                <select class="form-select" id="inputFilial" name="filial">
                                    <option value=""></option>
                                    @foreach($empresas as $empresa)
                                    @if($filial == $empresa->id_empresa)
                                    <option selected value="{{$empresa->id_empresa}}">{{$empresa->de_empresa}} - {{$empresa->regiao_empresa}}</option>
                                    @else
                                    <option value="{{$empresa->id_empresa}}">{{$empresa->de_empresa}} - {{$empresa->regiao_empresa}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-around">

                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataInicio">DATA INICIO</label>
                            <input class="form-control" value="{{$dt_inicio ?? ''}}" type="date" max="" name="dt_inicio" id="inputDataInicio">
                        </div>

                        <div class="input-group mb-3" style="width: 250px">
                            <label class="input-group-text" for="inputDataFim">DATA FIM</label>
                            <input class="form-control" value="{{$dt_fim ?? ''}}" type="date" min="" name="dt_fim" id="inputDataFim">
                        </div>


                        <div class="input-group mb-3" style="width: 250px">
                            <button type="submit" id="btn_busca_filtro" class="btn btn-primary" style="padding: 8px 12px; margin-right:6px; border-radius: 0.267rem">
                                <i class="bi bi-search"></i>
                            </button>

                            <button type="button" class="btn btn-warning" onclick="modalProvisionDate()" style="padding: 8px 12px; border-radius: 0.267rem">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>
                    </div>

                </form>

                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>NÚMERO</th>
                            <th>VALOR</th>
                            <th>PARCELAS</th>
                            <th>DATA DE CADASTRO</th>
                            <th>VENCIMENTO</th>
                            <th>STATUS</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($despesas) > 0)
                        @foreach($despesas as $despesa)
                        <tr class={{$despesa->de_status_despesa != 'EM ATRASO' ? "font-color-despesa" : "font-color-despesa-vencida"}}>
                            <td><input type="checkbox" name="ids_despesas" value="{{$despesa->id_despesa}}">{{$despesa->id_despesa}}</td>
                            <td>{{$mascara::maskMoeda($despesa->valor_total_despesa)}}</td>
                            <td>{{$despesa->qt_parcelas_despesa}}</td>
                            <td>{{$despesa->dt_inicio != null ? date("d/m/Y", strtotime($despesa->dt_inicio)) : ''}}</td>
                            <td>{{$despesa->dt_vencimento != null ? date("d/m/Y", strtotime($despesa->dt_vencimento)) : ''}}</td>
                            <td>{{$despesa->de_status_despesa}}</td>
                            <td class="d-flex justify-content-evenly">
                                <div>
                                    <i type="button" class="bi bi-caret-down-fill" id="abrir_parcelas_{{$despesa->id_despesa}}" onclick="getParcelas(this)" data-bs-toggle="collapse" href="#collapseExample-{{$despesa->id_despesa}}" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size: 25px; color: #820ad1">

                                    </i>
                                </div>
                                <div>
                                    <a href="/despesas/{{$despesa->id_despesa}}" class="btn btn-primary" style="padding: 8px 12px;">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </div>
                                <div>
                                    @if($despesa->de_status_despesa == 'A PAGAR' ||$despesa->de_status_despesa == 'EM ATRASO')
                                    <button data-bs-toggle="modal" data-bs-target="#delete{{$despesa->id_despesa}}" class="btn btn-danger" style="padding: 8px 12px;"><i class="bi bi-trash-fill"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                    <tbody id="parcela_{{$despesa->id_despesa}}">

                    </tbody>
                    </tr>

                    <!-- Inicio Modal Delete-->
                    <div class="modal-danger me-1 mb-1 d-inline-block">
                        <!--Danger theme Modal -->
                        <div class="modal fade text-left" id="delete{{$despesa->id_despesa}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title white" id="myModalLabel120">EXCLUSÃO</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente excluir a Despesa: {{$despesa->id_despesa}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Cancelar</span>
                                        </button>
                                        <form action="/despesas/delete/{{$despesa->id_despesa}}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Excluir</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fim Modal Delete-->
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6">DESPESA NÃO CADASTRADA</td>
                    </tr>
                    @endif
                    </tbody>

                </table>
                <div>
                    {{ $status_despesa ? $despesas->appends(['results' => $results, 'status' => $status_despesa, 'dt_inicio' => $dt_inicio, 'dt_fim' => $dt_fim])->links() : $despesas->appends(['results' => $results, 'status' => '', 'dt_inicio' => $dt_inicio, 'dt_fim' => $dt_fim])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/custom-js/mascara-dinheiro.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // const empresas = [];
    // let inputFilial = document.getElementById('inputFilial');
    // $(document).ready(function() {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/empresas',
    //         success: function(data) {
    //             console.log(data);
    //             $.each(data, function(key, val) {
    //                 $(inputFilial)
    //                     .append(
    //                         `<option value="${val.id_empresa}">${val.de_empresa} - ${val.regiao_empresa}</option>`
    //                     )
    //             });
    //         },
    //         fail: function() {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'ATENÇÃO',
    //                 text: "Erro ao tentar buscar as empresas!",
    //                 footer: ''
    //             })
    //         }
    //     });
    // });

    var inputDataInicio = '';
    $("#inputDataInicio").on("change", function() {
        inputDataInicio = $(this).val();
        $("#inputDataFim").prop("min", function() {
            return inputDataInicio;
        })
        console.log(inputDataInicio);
    })

    var inputDataFim = '';
    $("#inputDataFim").on("change", function() {
        inputDataFim = $(this).val();
        $("#inputDataInicio").prop("max", function() {
            return inputDataFim;
        })
        console.log(inputDataFim);
    })


    $("#btn_busca_filtro").click(function() {
        if (inputDataInicio != '' && inputDataFim == '') {
            console.log("Data Inicio preenchida");
            event.preventDefault();
            swal({
                title: "ATENÇÃO",
                text: "Preencha o campo DATA FIM!",
                icon: "warning",
                button: "Ok",
            });
        } else if (inputDataInicio == '' && inputDataFim != '') {
            console.log("Data Fim preenchida");
            event.preventDefault();
            swal({
                title: "ATENÇÃO",
                text: "Preencha o campo DATA INICIO!",
                icon: "warning",
                button: "Ok",
            });
        }
    });


    function getExpenseId() {
        const ids = [];
        $('input[name="ids_despesas"]:checked').each(function() {
            ids.push($(this).val());
        });

        return ids;
    }

    function setProvisionDate(ids, date) {
        if (ids.length > 0 && date != '') {
            $.ajax({
                type: 'POST',
                url: '/despesas/edit/provision-date',
                data: {
                    "_token": "{{ csrf_token() }}",
                    ids: ids,
                    date: date,
                },
                success: function() {

                    Swal.fire({
                        icon: 'success',
                        title: 'SUCESSO',
                        text: 'Data de provisionamento alterada com sucesso!',
                        footer: ''
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    })
                },
                fail: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'ATENÇÃO',
                        text: "Erro ao tentar alterar a data de provisionamento!",
                        footer: ''
                    })
                }
            })
        } else if (ids.length == 0) {
            Swal.fire({
                icon: "error",
                title: 'ATENÇÃO',
                text: "Selecione pelo menos uma despesa!",
                footer: ''
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'ATENÇÃO',
                text: "Preencha todos os campos!",
                footer: ''
            })
        }
    }

    function modalProvisionDate() {
        var date;
        Swal.fire({
            title: '<h3>EDITAR DATA DE PROVISIONAMENTO</h3>',
            html: '<div class="input-group mx-auto" style="width: 250px">' +
                `<input type="date" class="form-control" id="provision_date"/>` +
                '</div>',
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonText: 'Enviar',
            focusConfirm: false,
        }).then((result) => {
            var date = document.getElementById("provision_date").value;
            if (result.isConfirmed) {
                setProvisionDate(getExpenseId(), date);
            }
        })
    }


    function getParcelas(object) {
        var href = object.getAttribute("href");
        var id = href.substring(href.indexOf("-") + 1);

        let expanded = event.target.getAttribute("aria-expanded");
        event.target.setAttribute("aria-expanded", (expanded == "true") ? "false" : "true");

        let icon = event.target.getAttribute("class");
        event.target.setAttribute("class", (expanded == "true") ? "bi bi-caret-up-fill" : "bi bi-caret-down-fill");

        if (expanded == 'true') {
            $.ajax({
                type: "GET",
                url: `/parcelas/${id}`,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.length > 0) {
                        for (i = 0; i < response.length; i++) {
                            $(`#parcela_${id}`).append(
                                `<tr class="table-dark tr_generated_${id}">` +
                                "<td>" + response[i].id_parcela_despesa + '</td>' +
                                "<td>" + response[i].valor_parcela + '</td>' +
                                `<td>${response[i].num_parcela}</td>` +
                                "<td>" + response[i].dt_emissao + "</td>" +
                                "<td>" + response[i].dt_vencimento + "</td>" +
                                `<td>${response[i].de_status_despesa}</td>` +
                                "<td><a href='/parcelas/detalhes/" + response[i].id_parcela_despesa + "' class='btn btn-primary' style='padding: 8px 12px;'><i class='bi bi-eye-fill'></i></a></td>"
                            );
                        }
                    } else {
                        $(`#parcela_${id}`).append(
                            `<tr class="table-light tr_generated_${id}">` +
                            `<td><span style="color: red; font-weight: bold;">Não há parcelas</span></td>` +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "<td></td>" +
                            "</tr>"
                        );
                    }
                },
            });
        } else {
            expanded = 'true';
            $(`.tr_generated_${id}`).remove();
        }
    }
</script>


@endsection
