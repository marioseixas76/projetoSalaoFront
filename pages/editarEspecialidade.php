<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");

if (isset($_GET['id'])) {
    $especialidadeId = $_GET['id'];
} else {
    echo "Especialidade não encontrada.";
}


$url = 'http://localhost/api/especialidade/' . $especialidadeId;
$response = file_get_contents($url);
$data = json_decode($response, true);
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
            <h1><i class="fa-solid fa-spa"></i><span class="">&emsp;&emsp;Editar Especialidade</span></h1>
            <form class="form-cadastro" id="form-cadastro-especialidade">
                <div class="">
                    <div class="col-md-10">
                        <label for="especialidade" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" id="especialidade" value="<?php echo $data['nome']; ?>">
                    </div>

                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary">Editar</button>
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
                url: 'http://localhost:80/api/especialidade/<?php echo $data['id']; ?>',
                method: 'PUT',
                data: JSON.stringify({
                    nome: $('#especialidade').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Especialidade editada com sucesso!', 'Sucesso');
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