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
            <h1><i class="fa-solid fa-suitcase"></i><span class="">&emsp;&emsp;Cadastro Serviço</span></h1>
            <form class="form-cadastro" id="form-cadastro-servico">
                <div class="input-duplo">
                    <div class="col-md-10">
                        <label for="ds_servico" class="form-label">Serviço</label>
                        <input type="text" class="form-control" id="ds_servico">
                    </div>
                    <div class="col-md-10">
                        <label for="vl_servico" class="form-label">Valor Serviço</label>
                        <input type="number" class="form-control" id="vl_servico">
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

        $("#form-cadastro-servico").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'http://localhost/api/servico',
                method: 'POST',
                data: JSON.stringify({
                    ds_servico: $('#ds_servico').val(),
                    vl_servico: $('#vl_servico').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Nova serviço cadastrado com sucesso!', 'Sucesso');
                    window.location.href = "servicos.php";
                },
                error: function () {
                    $('#mensagem').text('Erro ao processar a requisição.');
                }
            })
        })

    });

</script>

</html>