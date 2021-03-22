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
        var cpf = $('#cpf').val();


        var data_args = {
            'clinica' : clinica,
            'nome_paciente' : nome_paciente,
            'convenio' : convenio,
            'plano' : plano,
            'numero_carterinha' : numero_carterinha,
            'cpf' : cpf
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

    /*$("div#alunosrepoderam").on('show.bs.modal', function(e) {
        
        var cod_questao = $(e.relatedTarget).data('codquestao');
    
        var data_args = {
            'cod_questao' : cod_questao,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/aluno/alunos_responderam',
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


    $("div#alterar-aluno").on('show.bs.modal', function(e) {

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/aluno/dados_aluno',
            data: '',
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

    $("div#alterar-aluno").on('click', 'button.alterar-aluno', function(e) {

        e.preventDefault();

        var nome_aluno = $('#nome_aluno').val();
        var email_aluno = $('#email_aluno').val();

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/alterar_aluno',
            data: {
                    'nome_aluno': nome_aluno,
                    'email_aluno': email_aluno,
                },
            beforeSend: function() {

            },
            success: function(retorno) {
                console.log("sucesso " + retorno);
                //alert(retorno.status)
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
                        window.location = URL_BASE+'app/alunos/principal';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {
                   console.log("erro " +ev)
            }
        });

        

    });*/


});



    /*$('#table_admin').DataTable();

    $('form[name=form-nova-configuracao]').on('blur', 'input[name=cep]', function(e){
        var cep = $('#cep').val().replace(/[^\d]+/g,'');
        var form = $(this).closest('form');

        if (cep!='' && cep.length==8) {
            var cep_url = "https://viacep.com.br/ws/" + cep + "/json/";

            $.ajax({
                url: cep_url,
                type: "GET",
                dataType: "jsonp",
                crossOrigin: true,
                crossDomain: true,
                contentType: "application/json; charset=utf-8",
                beforeSend: function() {

                },
                success: function(response){
                    console.log(response);
                    if (!response.erro) {
                        form.find('input[name=uf]').val(response.uf);
                        form.find('input[name=cidade]').val(response.localidade);
                        form.find('input[name=endereco]').val(response.logradouro);
                        form.find('input[name=complemento]').val(response.complemento);
                        form.find('input[name=bairro]').val(response.bairro);
                    } else {
                        /*form.find('select[name=id_estado_comprador]').val('0').trigger('change').addClass('border-danger');

                        form.find('input[name=no_endereco_comprador]').val('').addClass('border-danger');
                        form.find('input[name=no_bairro_comprador]').val('').addClass('border-danger');
                        form.find('input[name=no_complemento_comprador]').val('').addClass('border-danger');*/
                    /*}

                },
                error: function(ev, xhr, settings, error) {

                }
            });
        } else {

        }
    });


    $('form[name=form-nova-configuracao]').on('click', 'button.enviar-anuncio', function(e){
        e.preventDefault();

        var nome = $('#nome_bar').val();
        var id_categoria = $('#categoria').val();
        var email = $('#email').val();
        var telefone_contato = $('#telefone_contato').val();
        var cep = $('#cep').val();
        var uf = $('#uf').val();
        var cidade = $('#cidade').val();
        var endereco = $('#endereco').val();
        var complemento = $('#complemento').val();
        var bairro = $('#bairro').val();
        var numero = $('#numero').val();
        var descricao = $('#descricao').val();

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/salvar_anuncio',
            data: {
                    'nome': nome,
                    'email': email,
                    'id_categoria': id_categoria,
                    'telefone_contato': telefone_contato,
                    'cep': cep,
                    'uf': uf,
                    'cidade': cidade,
                    'endereco': endereco,
                    'complemento': complemento,
                    'bairro': bairro,
                    'numero': numero,
                    'descricao': descricao
                },
            beforeSend: function() {

            },
            success: function(retorno) {
                console.log("sucesso " + retorno);
                //alert(retorno.status)
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
                        window.location = URL_BASE+'app/cliente/anuncios';
                    }
                });
            },
            error: function(ev, xhr, settings, error) {
                   console.log("erro " +ev)
            }
        });

    });


    $('div#desativarAnuncioModal').on('show.bs.modal', function (event) {
        var id_anuncio = $(event.relatedTarget).data('idanuncio');
        var obj_modal = $(this).closest('.modal');

        var data_args = {
            'id_anuncio' : id_anuncio,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/desativar_anuncio',
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

    $("table#table_admin").on('click', 'a.desativar-anuncio', function(e) {
        e.preventDefault();
        var id_anuncio = $(this).data('idanuncio');
        var nome_anuncio = $(this).data('nomeanuncio');

        swal({
            title: 'Desativar Anúncio?',
            text: 'Tem certeza que deseja desativar o anúncio "'+nome_anuncio+'"?',
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
                    url: URL_BASE+'app/cliente/desativar_anuncio',
                    data: 'id_anuncio='+id_anuncio,
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


    $("table#table_admin").on('click', 'a.ativar-anuncio', function(e) {
        e.preventDefault();
        var id_anuncio = $(this).data('idanuncio');
        var nome_anuncio = $(this).data('nomeanuncio');

        swal({
            title: 'Ativar Anúncio?',
            text: 'Tem certeza que deseja ativar o anúncio "'+nome_anuncio+'"?',
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
                    url: URL_BASE+'app/cliente/ativar_anuncio',
                    data: 'id_anuncio='+id_anuncio,
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


    $("table#table_admin").on('click', 'a.desativar-foto', function(e) {
        e.preventDefault();
        var id_anuncio = $(this).data('idanuncio');
        var nome_anuncio = $(this).data('nomeanuncio');
        var id_foto = $(this).data('idfoto');

        swal({
            title: 'Desativar Foto do Anúncio?',
            text: 'Tem certeza que deseja desativar a fotos do anúncio "'+nome_anuncio+'"?',
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
                    url: URL_BASE+'app/cliente/desativar_foto',
                    data: 'id_foto='+id_foto,
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


    $("table#table_admin").on('click', 'a.ativar-foto', function(e) {
        e.preventDefault();
        var id_anuncio = $(this).data('idanuncio');
        var nome_anuncio = $(this).data('nomeanuncio');
        var id_foto = $(this).data('idfoto');

        swal({
            title: 'Ativar Foto do Anúncio?',
            text: 'Tem certeza que deseja ativar a fotos do anúncio "'+nome_anuncio+'"?',
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
                    url: URL_BASE+'app/cliente/ativar_foto',
                    data: 'id_foto='+id_foto,
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


    $('div#redeSocialModal').on('show.bs.modal', function (event) {
        var id_anuncio = $(event.relatedTarget).data('idanuncio');

        var data_args = {
            'id_anuncio' : id_anuncio,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/detalhes_rede',
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


    $('div#redeSocialModal').on('click', 'button.salvar-rede', function (e) {
        e.preventDefault();
        var data_args = {
            'id_anuncio' : $("#id_anuncio").val(),
            'url_facebook' : $("#url_facebook").val(),
            'url_twitter' : $("#url_twitter").val(),
            'url_instagran' : $("#url_instagran").val(),
            'url_youtube' : $("#url_youtube").val(),
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/salvar_rede',
            data: data_args,
            context: this,
            beforeSend: function() {

            },
            success: function(retorno) {
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

    });

    $('div#planosModal').on('show.bs.modal', function (event) {

        var data_args = {'':''};

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/listar_planos',
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


    $('div#planosModal').on('click', 'button.enviar-plano', function (e) {
        e.preventDefault();
        var data_args = {
            'id_plano' : $("#id_plano").val(),
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/cliente/link_pagseguro',
            data: data_args,
            context: this,
            beforeSend: function() {

                $(".loader").css("display","block")
                $(".loader").delay(100000).fadeOut("slow");

            },
            success: function(retorno) {
                switch (retorno.status) {
                    case 'erro':
                        var alerta = swal("Erro!",retorno.message,"error");
                        break;
                    case 'sucesso':
                        window.location = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code='+retorno.code;
                        break;
                    case 'alerta':
                        var alerta = swal("Ops!",retorno.message,"warning");
                        break;
                    default:
                        var alerta = swal("Ops!", 'O servidor não retornou um status.', "warning");
                        break;
                }
            },
            error: function(ev, xhr, settings, error) {

            }
        });


    });*/




