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
                        window.location = URL_BASE+'home/';
                        //var alerta = swal("Sucesso!",retorno.msg,"success");
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
                        //window.location = URL_BASE+'home/';
                        location.reload();
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
                        //window.location = URL_BASE+'home/';
                        location.reload();
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
                        //window.location = URL_BASE+'home/';
                        location.reload();
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });

        //alert('oiiii');

    });


    $("div#salvar_clinica").on('click', 'button.salvar-clinica', function(e) {

        e.preventDefault();

        var nome_clinica = $('#nome_clinica').val();

        var data_args = {
            'nome_clinica' : nome_clinica,
        };


        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_clinica',
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


    $("div#usuario_clinica").on('click', 'button.salvar-clinica-usuario', function(e) {

        e.preventDefault();

        var nome_usuario_clinica = $('#nome_usuario_clinica').val();
        var email_usuario_clinica = $('#email_usuario_clinica').val();
        var id_clinica_usuario_clinica = $('#id_clinica_usuario_clinica').val();

        var data_args = {
            'nome_usuario_clinica' : nome_usuario_clinica,
            'email_usuario_clinica' : email_usuario_clinica,
            'id_clinica' : id_clinica_usuario_clinica,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_clinica_usuario',
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


    $("div#ativar_desativar_clinica").on('show.bs.modal', function(e) {

        var id_clinica = $(e.relatedTarget).data('idclinica');
        var ativar_deativar = $(e.relatedTarget).data('ativardesativar');

        var data_args = {
            'id_clinica' : id_clinica,
            'ativar_deativar' : ativar_deativar,
        };

        $.ajax({
            type: "GET",
            url: URL_BASE+'app/admin/ativar_desativar_clinica',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body form').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
    });

    $("div#ativar_desativar_clinica").on('click', 'button.ativar-desativar-clinica', function(e) {

        e.preventDefault();
        var id_clinica = $('#id_clinica_ativar_desativar').val();
        var ativar_desativar = $('#ativar_desativar').val();
        var data_args = {
            'id_clinica' : id_clinica,
            'ativar_desativar' : ativar_desativar,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_ativar_desativar_clinica',
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
                        window.location = URL_BASE+'app/admin/clinicas';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
    });

    $("div#ativar_desativar_usuario").on('show.bs.modal', function(e) {

        var id_user = $(e.relatedTarget).data('iduser');
        var ativar_deativar = $(e.relatedTarget).data('ativardesativar');

        var data_args = {
            'id_user' : id_user,
            'ativar_deativar' : ativar_deativar,
        };

        $.ajax({
            type: "GET",
            url: URL_BASE+'app/admin/ativar_desativar_usuario',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body form').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
    });

    $("div#ativar_desativar_usuario").on('click', 'button.ativar-desativar-usuario', function(e) {
        //e.preventDefault();
        var id_user = $('#id_usuario_ativar_desativar').val();
        var ativar_desativar = $('#ativar_desativar').val();
        var data_args = {
            'id_user' : id_user,
            'ativar_desativar' : ativar_desativar,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_ativar_desativar_usuario',
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
                        window.location = URL_BASE+'app/admin/relatorio_usuario';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
    });

    $("div#alterar_senha_usuario").on('show.bs.modal', function(e) {

        var id_user = $(e.relatedTarget).data('iduser');

        var data_args = {
            'id_user' : id_user
        };

        $.ajax({
            type: "GET",
            url: URL_BASE+'app/admin/alterar_senha_usuario',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
                $(this).find('.modal-body form').html(retorno);
            },
            error: function(ev, xhr, settings, error) {

            }
        });
    });


    $("div#alterar_senha_usuario").on('click', 'button.alterar-senha-usuario', function(e) {
        //e.preventDefault();
        var id_user = $('#id_user').val();
        var senha = $('#usuario_senha').val();
        var data_args = {
            'id_user' : id_user,
            'senha' : senha
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/admin/salvar_alterar_senha_usuario',
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
                        window.location = URL_BASE+'app/admin/relatorio_usuario';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {

                console.log("erro " +ev);

            }
        });
    });



});

function excluir_processo(id_processo,protocolo){

    swal({
        title: 'Desativar Processo',
        text: 'Tem certeza que deseja desativar o Processo com Protocolo ' + protocolo + " ? ",
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
                data: 'id_processo='+id_processo,
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
}

function deletar_clinica(id_clinica,nome_clinica){

    swal({
        title: 'Deletar Clinica',
        text: 'Tem certeza que deseja deletar a clínica ' + nome_clinica + " ? ",
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
                url: URL_BASE+'app/admin/deletar_clinica',
                data: 'id_clinica='+id_clinica,
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
}

