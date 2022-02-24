function adicionaPix(){
    var titular = $("#input_razao_social").val();
    var id_titular_pix = $("#fk_empregado_fornecedor").val();
    var tipo_do_titular = $("input[name=tipo_despesa]:checked").val();

    $("#id_titular_pix").val(id_titular_pix);
    $("#tipo_do_titular").val(tipo_do_titular);

    $("#titular_conta_pix").val(titular);

    if (titular == "") {
        swal({
            title: "Atenção",
            text: "Selecione um fornecedor ! ",
            icon: "warning",
            button: "Ok",
        });
        return false;
    }
    else{
        limpaCamposContaPix();
        $.ajax({
            url: "/pix/tipo-pix",
            type: "GET",
            dataType: "json",
            success:function (response){
                $.each(response, function(key, val){
                    $("#select_tipo_pix").append(
                        `<option id="option_Pix" value="${val.id_tipo_pix}" > ${val.de_tipo_pix} </option>`
                        );
                    });
            },
            error: function () {
                swal({
                    title: "Erro",
                    text: "Erro ao buscar instituições financeiras!",
                    icon: "error",
                    button: "Ok",
                });
            },
        });
    }
}


$(function(){

    $("#select_tipo_pix").on('change',function(){

         if($("#select_tipo_pix").val() == 1){
             // validad o tamanho do cpf
           $("#input_pix").attr('maxlenght',14);
           $("#input_pix").val('');

        }
        else if($("#select_tipo_pix").val() == 2){
            // validad o tamanho do EMAIL
           $("#input_pix").attr('maxlenght',150);
           $("#input_pix").val('');

        }
        else if($("#select_tipo_pix").val() == 3){
          // validad o tamanho do Telefone
           $("#input_pix").attr('maxlenght',11);
           $("#input_pix").val('');
        }
         else if ($("#select_tipo_pix").val() == 4) {
            // validad o tamanho da CHAVE ALEATÓRIA
        $("#input_pix").attr('','maxlenght',32);
        $("#input_pix").val('');
        }
    })

    if($("#select_tipo_pix").val() == 1){
        if($("#input_pix").val().trim() == ""){
            $("#input_pix").focus();
            $("#erro_input_pix")
                .html("Por favor insira um pix valido !")
                .css({ color: "red", fontStyle: "italic"});
                return false;
        }
    }


    // submit do modal de pix
    $('form[name="form_conta_pix"]').submit(function (e){
        e.preventDefault();

        // INCIO DO AJAX
        $.ajax({
            url:"/pix/store",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data){
                swal({
                    title: "Sucesso",
                    text: "Pix cadastrada com sucesso!",
                    icon: "success",
                    button: "OK",
                });
                $("#select_tipo_pix").val("");
                $("#input_pix").val("");
                $("#condicao_pagamento").val("");
            },
            error: function (data) {
                swal({
                    title: "Erro",
                    text: "Erro ao cadastrar",
                    icon: "error",
                    button: "Ok",
                })
            },
        });
        // FIM  DO AJAX

    })
});
