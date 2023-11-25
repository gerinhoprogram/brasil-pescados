var App_usuarios = function() {

    // envia imagens para o controller usuarios
    var envia_imagem = function() {

        // quando muda o valor de user_foto_file aciona essa função
        $(document).on('change', '[name="user_foto_file"]', function() {

                // alert('success');

                var file_data = $('[name="user_foto_file"]').prop('files')[0];

                var form_data = new FormData();

                form_data.append('user_foto_file', file_data);

                $.ajax({

                    type: 'post',
                    url: BASE_URL + 'restrita/usuarios/upload_file',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    beforeSend: function() {

                        // Mostra temporariamente quando estiver consultando
                        $('#carregando').html('Carregando...');

                    },
                    success: function(response) {

                        if (response.erro === 0) {

                            $('#carregando').html('');
                            $('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='" + response.user_foto + "'> <img src='" + BASE_URL + "/uploads/usuarios/" + response.user_foto + "' class='rounded-circle' width='100' alt=''>");

                        } else {

                            $('#user_foto').html(response.mensagem);

                        }

                    },
                    error: function(response) {

                        $('#user_foto').html(response.mensagem);

                    }

                });

            }

        )
    };


    // inicia as funções
    return {
        init: function() {
            envia_imagem();
        }
    }
}(); //inicializa ao carregar a view

jQuery(document).ready(function() {

    $(window).keydown(function() {

        if (event.keyCode === 13) {

            event.preventDefault();
            return false;

        }

    });

    App_usuarios.init();

});