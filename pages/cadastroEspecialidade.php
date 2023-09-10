<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?php
            include_once("../templates/menu.php") ?>
        </div>
        <div class="col-md-10 titulo-page">
            <?php
            include_once("../templates/header.php");
            ?>
            <h1><i class="fa-solid fa-spa"></i><span class="">&emsp;&emsp;Cadastro Especialidade</span></h1>
            <form class="form-cadastro " id="form-cadastro-especialidade">
                <div class="input-unico">
                    <div class="col-md-10 input-cadastro">
                        <label for="especialidade" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" id="especialidade">
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary botao-login">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {

        $("#form-cadastro-especialidade").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'http://localhost/api/especialidade',
                method: 'POST',
                data: JSON.stringify({
                    nome: $('#especialidade').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Nova especialidade cadastrada com sucesso!', 'Sucesso');
                    window.location.href = "especialidade.php";
                },
                error: function () {
                    $('#mensagem').text('Erro ao processar a requisição.');
                }
            })
        })

    });

</script>

</html>