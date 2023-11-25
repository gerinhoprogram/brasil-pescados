var App_registrar = function() {

    //envia campos do cep para preenchimento automático
    var preenche_endereco = function() {

        $('[name=user_cep]').focusout(function() {

            var user_cep = $(this).val();

            // alert(BASE_URL);

            $.ajax({

                type: 'post',
                url: BASE_URL + 'registrar/preenche_endereco',
                dataType: 'json',
                data: { user_cep: user_cep },
                beforeSend: function() {

                    // Mostra temporariamente quando estiver consultando
                    $('#user_cep').html('Consultando o cep...');

                },
                success: function(response) {

                    if (respnse.erro === 0) {

                        $('#user_cep').html('');

                        if (!response.user_endereco) {

                            //adiciona class 
                            $('[name=user_endereco]').addClass('bg_while');
                            //prop readonly para false
                            $('[name=user_endereco]').prop('readonly', false);

                            $('[name=user_bairro]').addClass('bg_while');
                            $('[name=user_bairro]').prop('readonly', false);

                        }

                        // preenche os campos na view
                        $('[name=user_endereco]').val(resonse.user_endereco);
                        $('[name=user_bairro]').val(resonse.user_bairro);
                        $('[name=user_cidade]').val(resonse.user_cidade);
                        $('[name=user_estado]').val(resonse.user_estado);

                    } else {
                        $('#user_cep').html(response.user_cep);
                    }

                },
                error: function(response) {

                    $('#user_cep').html(response.mensagem);

                }

            });

        });

    }


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
                    url: BASE_URL + 'registrar/upload_file',
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
                            $('#box-foto-usuario').html("<input type='hidden' name='user_foto' value='" + response.user_foto + "'> <img src='" + BASE_URL + "/uploads/usuarios/small/" + response.user_foto + "' class='rounded-circle' width='100' alt=''>");

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
            preenche_endereco();
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

    App_registrar.init();

});