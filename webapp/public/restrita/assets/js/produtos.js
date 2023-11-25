$('#master').on('change', function() {

    var produto_categoria_pai_id = $(this).val();

    // alert(produto_categoria_pai_id);

    if (produto_categoria_pai_id) {

        $.ajax({

            type: 'POST',
            url: BASE_URL + 'restrita/produtos/get_categorias_filhas',
            dataType: 'json',
            data: { produto_categoria_pai_id: produto_categoria_pai_id },

            success: function(data) {

                // renderiza um valor texto caso tenha sucesso
                $('#produto_categoria').html('<option value="">Escolha uma subcategoria...</option>');

                // verifica se o data tem valor
                if (data) {

                    $(data).each(function() {

                        var option = $('<option/>');

                        // variavel setamos o atributo value o id da categoria filha
                        // e no atributo text coloca o nome da categoria
                        option.attr('value', this.categoria_id).text(this.categoria_nome);

                        $('#produto_categoria').append(option);

                    });

                } else {
                    $('#produto_categoria').html('<option value="">Subcategorias não encontradas</option>')
                }

            },

        });

    } else {
        // não foi escolhida nenhuma categoria pai
        // renderiza no id produto_categoria
        $('#produto_categoria').html('<option value="">Escolha uma categoria principal...</option>')
    }

});