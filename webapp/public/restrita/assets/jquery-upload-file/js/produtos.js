$(document).ready(function() {
    $("#fileuploader").uploadFile({
        url: BASE_URL + "restrita/produtos/upload",
        fileName: "foto_produto",
        returnType: "json",
        onSuccess: function(files, data) {

            if (data.erro === 0) {
                $("#uploaded_image").append('<ul style="list-style: none; display: inline-block"><li class="text-center"><img src="' + BASE_URL + 'uploads/produtos/' + data.uploaded_data['file_name'] + '" width="120" class="img-thumbnail mb-2 mr-1"><input type="hidden" name="fotos_produtos[]" value="' + data.foto_nome + '"><div class="btn bg-danger btn-block btn-icon text-white mx-auto mb-30 btn-remove" style="width: 100%; margin-top: 5px"><i class="fas fa-trash-alt"></i></div></li></ul>');
            } else {

                $("#erro_uploaded").html(data.mensagem);
            }

        },
    });


    $('#uploaded_image').on('click', '.btn-remove', function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-danger text-white ml-2',
                cancelButton: 'btn bg-primary text-white mr-20'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Tem certeza da exclusão?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-exclamation-circle"></i>&nbsp;Excluir!',
            cancelButtonText: '<i class="fa fa-arrow-circle-left"></i>&nbsp;Cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(this).parent().remove();
            } else {
                return false;
            }
        })
    });

});