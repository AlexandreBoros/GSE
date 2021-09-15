$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".loader").delay(1500).fadeOut("slow");


    $("div#adicionar_pendecia").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/clinica/adicionar_pendecia',
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

    $("div#upload").on('show.bs.modal', function(e) {

        var id_propcesso = $(e.relatedTarget).data('idpropcesso'); 

        var data_args = {
            'id_propcesso' : id_propcesso,
        };

        $.ajax({
            type: "POST",
            url: URL_BASE+'app/clinica/upload',
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
            url: URL_BASE+'app/clinica/lista_upload',
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

   


});



    