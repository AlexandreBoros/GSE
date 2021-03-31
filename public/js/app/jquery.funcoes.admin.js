$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".loader").delay(1500).fadeOut("slow");

    $("div#convenioModal").on('click', 'button.enviar-convenio', function(e) {

        e.preventDefault();

        var clinica = $('#clinica').val();
        var nome_paciente = $('#nome_paciente').val();
        var convenio = $('#convenio').val();
        var plano = $('#plano').val();
        var numero_carterinha = $('#numero_carterinha').val();
        var protocolo = $('#protocolo').val();
        var valor_nf = $('#valor_nf').val();
        var valor_pago = $('#valor_pago').val();
        var dt_pagqamento = $('#dt_pagqamento').val();
        var porcentagem_gse = $('#porcentagem_gse').val();
        var senha = $('#senha').val();
        var cpf = $('#cpf').val();
        var tipo_envio = $('#tipo_envio').val();


        var data_args = {
            'clinica' : clinica,
            'nome_paciente' : nome_paciente,
            'convenio' : convenio,
            'plano' : plano,
            'numero_carterinha' : numero_carterinha,
            'protocolo' : protocolo,
            'valor_nf' : valor_nf,
            'valor_pago' : valor_pago,
            'dt_pagqamento' : dt_pagqamento,
            'porcentagem_gse' : porcentagem_gse,
            'senha' : senha,
            'cpf' : cpf,
            'tipo_envio' : tipo_envio
        };


        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_convenio',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                switch (retorno.status){
                    case 'erro':
                        var alerta = swal("Erro!",retorno.msg,"error");
                        break;
                    case 'sucesso':
                        var alerta = swal("Sucesso!",retorno.msg,"success");
                        break;
                }
                alerta.then(function () {
                    if (retorno.recarrega == 'true') {
                        window.location = URL_BASE+'home/';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
         
        //alert('oiiii');

    });


    $("div#alterar_status_processo").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/status_processo',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
         

    });


    $("div#alterar_status_processo").on('click', 'button.alterar-status', function(e) {
    
        e.preventDefault();

        var id_propcesso = $('#id_propcesso').val();
        var id_processo_status = $('#id_processo_status').val();

        var data_args = {
            'id_propcesso' : id_propcesso,
            'id_processo_status' : id_processo_status,
        };


        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/alterar_status_processo',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                switch (retorno.status){
                    case 'erro':
                        var alerta = swal("Erro!",retorno.msg,"error");
                        break;
                    case 'sucesso':
                        var alerta = swal("Sucesso!",retorno.msg,"success");
                        break;
                }
                alerta.then(function () {
                    if (retorno.recarrega == 'true') {
                        window.location = URL_BASE+'home/';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
    
    });

    $("div#adicionar_pendecia").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/adicionar_pendecia',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
         

    });


    $("div#adicionar_pendecia").on('click', 'button.salvar_pendencia', function(e) {
    
        e.preventDefault();

        var id_propcesso = $('#id_propcesso').val();
        var pendencia_texto = $('#pendencia_texto').val();

        var data_args = {
            'id_propcesso' : id_propcesso,
            'pendencia_texto' : pendencia_texto,
        };


        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_pendecia',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                switch (retorno.status){
                    case 'erro':
                        var alerta = swal("Erro!",retorno.msg,"error");
                        break;
                    case 'sucesso':
                        var alerta = swal("Sucesso!",retorno.msg,"success");
                        break;
                }
                alerta.then(function () {
                    if (retorno.recarrega == 'true') {
                        window.location = URL_BASE+'home/';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
    
    });

    $("div#upload").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/upload',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
         

    });

    $("div#lista_upload").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/lista_upload',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
         

    });


    $("div#alterar_processo").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/dados_processo',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
         

    });


    $("div#alterar_processo").on('click', 'button.alterar_processo', function(e) {

        //e.preventDefault();

        var form = $('form[name=form-alterar-processo]');

        var id_propcesso =  $('#id_propcesso').val();


       

        var clinica = $('#id_clinica_processo').val();
        var nome_paciente = $('#nome_paciente_processo').val();
        var convenio = $('#convenio_processo').val();
        var plano = $('#plano_processo').val();
        var numero_carterinha = $('#numero_carterinha_processo').val();
        var protocolo = $('#protocolo_processo').val();
        var valor_nf = $('#valor_nf_processo').val();
        var valor_pago = $('#valor_pago_processo').val();
        var dt_pagqamento = $('#dt_pagqamento_processo').val();
        var porcentagem_gse = $('#porcentagem_gse_processo').val();
        var senha = $('#senha_processo').val();
        var cpf = $('#cpf_processo').val();
        var tipo_envio = $('#tipo_envio_processo').val();


        var data_args = {
            'clinica' : clinica,
            'nome_paciente' : nome_paciente,
            'convenio' : convenio,
            'plano' : plano,
            'numero_carterinha' : numero_carterinha,
            'protocolo' : protocolo,
            'valor_nf' : valor_nf,
            'valor_pago' : valor_pago,
            'dt_pagqamento' : dt_pagqamento,
            'porcentagem_gse' : porcentagem_gse,
            'senha' : senha,
            'cpf' : cpf,
            'tipo_envio' : tipo_envio,
            'id_propcesso' : id_propcesso
        };

       //alert(JSON.stringify(data_args));


        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/atualizar_processo',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                switch (retorno.status){
                    case 'erro':
                        var alerta = swal("Erro!",retorno.msg,"error");
                        break;
                    case 'sucesso':
                        var alerta = swal("Sucesso!",retorno.msg,"success");
                        break;
                }
                alerta.then(function () {
                    if (retorno.recarrega == 'true') {
                        window.location = URL_BASE+'home/';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
         
        //alert('oiiii');

    });


    $("table#table_alunos").on('click', 'a.excluir_processo', function(e) { 

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        alert(JSON.stringify(id_propcesso));
       
        swal({
            title: 'Desativar Processo',
            text: 'Tem certeza que deseja desativar o Processo ?' + id_propcesso,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            showLoaderOnConfirm: true,
        }).then(function(retorno) {
            if (retorno.value == true ) {
                $.ajax({
                    type: "POST",
                    url: URL_BASE+'app/admin/excluir_processo',
                    data: 'id_propcesso='+id_propcesso,
                    context: this,
                    beforeSend: function () {

                    },
                    success: function (retorno) {
                        switch (retorno.status) {
                            case 'erro':
                                var alerta = swal("Erro!",retorno.message,"error");
                                break;
                            case 'sucesso':
                                var alerta = swal("Sucesso!",retorno.message,"success");
                                break;
                            case 'alerta':
                                var alerta = swal("Ops!",retorno.message,"warning");
                                break;
                            default:
                                var alerta = swal("Ops!", 'O servidor não retornou um status.', "warning");
                                break;
                        }
                        alerta.then(function(){
                            if (retorno.recarrega=='true') {
                                location.reload();
                            }
                        });

                    },
                    error: function(ev, xhr, settings, error) {

                    }
                });
            }
        });

    });


 
});
