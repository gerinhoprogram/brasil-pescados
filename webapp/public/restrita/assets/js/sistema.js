//preenchar campos ao sai do input cep
var App_sistema = function() {

    var envia_imagem_logo = function() {

        $(document).on('change', '[name="sistema_logo"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_logo"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_logo', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_logo',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    //definir disables
                    $('#carregando').html('<img src="' + BASE_URL + '/public/img/ajax-loader.gif">');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#carregando').html('');
                        $('#box-foto-logo').html("<input type='hidden' name='logo_foto_troca' value='" + response.logo_foto_troca + "' > <img src='" + BASE_URL + "uploads/sistema/" + response.logo_foto_troca + "' alt='' width='150' class='img-thumbnail mb-2 mr-1'> ");

                    } else {
                        $('#logo_foto_troca').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#logo_foto_troca').html(response.mensagem);

                }

            });

        });

    }

    var envia_imagem_icon = function() {

        $(document).on('change', '[name="sistema_icon"]', function() {

            // alert(BASE_URL);
            var file_data = $('[name="sistema_icon"]').prop('files')[0];

            var form_data = new FormData();

            form_data.append('sistema_icon', file_data);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'restrita/sistema/upload_icon',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                beforeSend: function() {
                    //definir disables
                    $('#carregando_icon').html('<img src="' + BASE_URL + '/public/img/ajax-loader.gif">');
                },

                success: function(response) {
                    // alert('sucesso');

                    if (response.erro === 0) {

                        $('#carregando_icon').html('');
                        $('#box-foto-icon').html("<input type='hidden' name='icon_foto_troca' value='" + response.icon_foto_troca + "' > <img src='" + BASE_URL + "uploads/sistema/" + response.icon_foto_troca + "' alt='' width='30' class='img-thumbnail mb-2 mr-1'> ");

                    } else {
                        $('#icon_foto_troca').html(response.mensagem);
                    }
                },

                error: function(response) {
                    // alert('erro');
                    $('#icon_foto_troca').html(response.mensagem);

                }

            });

        });

    }

    return {
        init: function() {
            envia_imagem_logo();
            envia_imagem_icon();
        }
    }

}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {

        // if (event.keyCode === 13) {

        //     event.preventDefault();
        //     return false;

        // }

    });

    App_sistema.init();

});