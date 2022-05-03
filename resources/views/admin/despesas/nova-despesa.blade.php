<!DOCTYPE html>
<html lang="en">
<body>
    <div id="hidden_inputs_tipo_documento"></div>

    <input type="hidden" name="numero_pix" value="">
    <input type="hidden" name="numero_conta_bancaria" value="">


    <input type="hidden" id="id_numero_documento1" value="" name="id_numero_documento[]" />
    <input type="hidden" id="id_numero_documento2" value="" name="id_numero_documento[]" />
    <input type="hidden" id="id_numero_documento3" value="" name="id_numero_documento[]" />
    <input type="hidden" id="numero_documento1" value="" name="numero_documento[]" />
    <input type="hidden" id="numero_documento2" value="" name="numero_documento[]" />
    <input type="hidden" id="numero_documento3" value="" name="numero_documento[]" />
    <br>
    <hr>
    <br>

    <div class="d-flex" style="width: 100%;justify-content:start; align-items:center">
        <div class="px-5 mb-3">
            <h3>RATEIO</h3>
            <button class="btn btn-primary" id="adicionar_rateio" type="button" data-bs-toggle="modal" data-bs-target="#xrateio" style="padding: 8px 12px;">
                <i class="bi bi-plus"></i>
            </button>
        </div>
    </div>

    <!-- Inicio da div da tabela de rateio -->
    <div class="d-flex" style="width: 100%;">
        <div class="px-5 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>EMPRESA</th>
                            <th>CENTRO DE CUSTO</th>
                            <th>RATEIO</th>
                            <th>%</th>
                            <th>EDITAR</th>
                        </tr>
                    </thead>

                    <tbody id="table_rateio">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fim da div da tabela de rateio -->

    <br>
    <hr>
    <br>
    <div class="d-flex" style="width: 100%">
        <div class="px-5 mb-3">
            <strong>QUANTIDADE PARCELAS</strong>
            <input required type="text" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" class="form-control input-add" name="parcelas" />
        </div>

        <div class="px-5 mb-3">
            <strong>TIPO DE PAGAMENTO</strong>
            <input required class="form-control input-add teste" name="tipo_pagamento" id="condicao_pagamento" readonly style="cursor: pointer;"></input>
            <div id="itens_tipo_pagamento" class="input-style" style="cursor: pointer;"></div>
        </div>
    </div>

    <div class="d-flex" style="width: 100%">
        <div class="px-5 mb-3" id="conta_hidden">
            <!-- CAMPO DE CONTA BANCARIA E PIX -->
        </div>

        <div class="px-5 mb-3" id="modal_conta">
            <!-- BUTTON MODAL -->
        </div>
    </div>

    <div class="d-flex" style="width: 100%;">
        <div class="px-5 mb-3">
            <strong>DATA DE VENCIMENTO</strong>
            <input required type="date" class="form-control input-add" id="dt_venc" name="data_vencimento" />
            <!-- id do span tem que ser (erro_ + id do input data) -->
            <span id="erro_dt_venc"></span>
        </div>

        <div class="px-5 mb-3">
            <strong>DATA DE PROVISIONAMENTO</strong>
            <input required type="date" onblur="return validaData(this)" class="form-control input-add" id="dt_prov" name="data_provisionamento" />
            <span id="erro_dt_prov"></span>
        </div>
    </div>

    <div class="d-flex" style="width: 100%">
        <div class="px-5 mb-3">
            <h3>INFORMAÇÕES ADICIONAIS</h3>
        </div>
    </div>

    <div class="d-flex flex-row" style="width: 100%; align-items:center;">
        <div class="px-5 mb-3">
            <div class="d-flex flex-column">
                <strong>TIPO DE DOCUMENTO </strong>
                <select required type="text" id="buscaDocumento" value="" class="form-control input-add mb-2">
                    <option id="resultsDocumentos" class="resultadoDocumento"></option>
                </select>
                <div>
                    <button class="btn btn-primary" id="btnAddDoc" type="button" style="padding: 8px 12px;">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="px-5 mb-3">
            <strong>DATA DE EMISSÃO</strong>
            <input type="date" class="form-control input-add" id="dt_emissao" name="data_emissao" />
            <span id="erro_dt_emissao"></span>
        </div>
    </div>

    <div class="d-flex flex-column" style="width:100%" id="inputDadosDoc">

    </div>



    <!-- Inicio Modal Adicionar-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="modal_conta_bancaria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">CONTA BANCÁRIA</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <form name="form_conta_bancaria">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TITULAR</strong>
                                    <input class="form-control input-busca" name="titular_conta" type="text" id="titular_conta" readonly style="width: 60rem" />
                                    <input name="id_titular_conta" type="hidden" id="id_titular_conta" />
                                    <input name="tipo_da_despesa" type="hidden" id="tipo_da_despesa" />
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>BANCO</strong>
                                    <select id="inst_financeiras" name="inst_financeira" class="form-control input-busca" style="width: 60rem">

                                    </select>
                                    <span id="erro_instituicao"></span>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>AGENCIA</strong>
                                    <input type="text" onkeypress="return onlynumber();" class="form-control" id="nu_agencia" name="nu_agencia" autocomplete="off" style="width: 28rem;">
                                    <span id="erro_agencia"></span>
                                </div>

                                <div class="px-3 mb-3">
                                    <strong>NUMERO DA CONTA</strong>
                                    <input type="text" onkeypress="return onlynumber();" class="form-control" id="nu_conta" name="nu_conta" autocomplete="off" style="width: 28rem;">
                                    <span id="erro_conta"></span>
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>CODIGO OPERAÇÃO</strong>
                                    <input type="text" class="form-control" onkeypress="return onlynumber();" id="co_operacao" name="co_operacao" autocomplete="off" style="width: 28rem;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i data-feather="check-circle"></i>ADICIONAR
                                </button>
                                <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                                    CANCELAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <!-- Inicio Modal Rateio-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="xrateio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">RATEIO</h4>

                        <div>
                            <span>VALOR TOTAL: </span>
                            <input class="input-add" id="modal_valor_total" name="modal_valor_total" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple; margin-right:20px">

                            <span>VALOR RATEADO: </span>
                            <input class="input-add" id="modal_valor_rateado" name="modal_valor_rateado" readonly style="width: 120px; border-radius: 3px; border: 1px solid purple">
                        </div>

                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>EMPRESA</strong>
                                <input class="form-control input-busca" type="text" id="rateio_empresa" autocomplete="off" placeholder="Empresa" style="width: 60rem" />
                                <div id="results_rateio_empresa" class="resultado-busca-rateio"></div>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>CENTRO DE CUSTO</strong>
                                <select class="form-control input-add" id="custo_rateio">
                                    <option selected value="" class="resultado-busca"></option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex" style="width: 100%">
                            <div class="px-5 mb-3">
                                <strong>VALOR RATEADO</strong>
                                <input class="form-control mt-1" id="valor_rateado" onkeyup="formataValor(this)" type="text" onkeypress="return onlynumber();" placeholder="Valor do item" style="width: 358px" />
                            </div>
                            <div class="d-flex flex-row" style="width: 100%; align-items:center">
                                <div>
                                    <input class="form-control mt-1" id="porcentagem_rateado" type="text" min="0" max="5" onkeyup="return validateValue(this);" onkeypress="return onlynumber();" maxlength="3" style="width: 58px" />
                                </div>

                                <div>
                                    <strong>%</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button class="btn btn-success me-1 mb-1" type="button" id="seleciona_rateio">
                                <i data-feather="check-circle"></i>ADICIONAR
                            </button>
                            <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                                CANCELAR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim modal Adicionar -->

    <!-- Inicio Modal Adicionar PIX-->
    <div class="me-1 mb-1 d-inline-block">
        <!--Extra Large Modal -->
        <div class="modal fade text-left w-100" id="modal_pix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">PIX</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x" data-feather="x"></i>
                        </button>
                    </div>
                    <form name="form_conta_pix">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TITULAR</strong>
                                    <input class="form-control input-busca" name="titular_conta_pix" type="text" id="titular_conta_pix" readonly style="width: 60rem" />
                                    <input name="id_titular_pix" type="hidden" id="id_titular_pix" />
                                    <input name="tipo_do_titular" type="hidden" id="tipo_do_titular" />
                                </div>
                            </div>

                            <div class="d-flex" style="width: 100%">
                                <div class="px-5 mb-3">
                                    <strong>TIPO</strong>
                                    <select id="select_tipo_pix" name="select_tipo_pix" class="form-control input-busca" style="width: 8rem">
                                    </select>
                                    <span id="erro_select_tipo_pix"></span>
                                </div>

                                <div class="px-5 mb-3">
                                    <strong>PIX</strong>
                                    <input type="text" class="form-control" onblur="validaCampo(this, keyPix.cpfCnpj)" id="input_pix" name="input_pix" maxlength="18" onkeypress="mascaraMutuario(this,cpfCnpj)" autocomplete="off" style="width: 46rem;">
                                    <span id="erro_pix"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i data-feather="check-circle"></i>ADICIONAR
                                </button>
                                <button type="button" class="close btn btn-secondary me-1 mb-1" data-bs-dismiss="modal" aria-label="Close">
                                    CANCELAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
