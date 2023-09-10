<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");

if (isset($_GET['id'])) {
    $servicoId = $_GET['id'];
} else {
    echo "Serviço não encontrada.";
}


$url = 'http://localhost/api/servico/' . $servicoId;
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
            <h1><i class="fa-solid fa-spa"></i><span class="">&emsp;&emsp;Editar Serviço</span></h1>
            <form class="form-cadastro" id="form-editar-servico">
                <div class="">
                    <div class="col-md-10">
                        <label for="ds_servico" class="form-label">Serviço</label>
                        <input type="text" class="form-control" id="ds_servico"
                            value="<?php echo $data['ds_servico']; ?>">
                    </div>
                    <div class="col-md-10">
                        <label for="vl_servico" class="form-label">Valor</label>
                        <input type="text" class="form-control" id="vl_servico"
                            value="<?php echo $data['vl_servico']; ?>">
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

        $("#form-editar-servico").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: 'http://localhost:80/api/servico/<?php echo $data['id']; ?>',
                method: 'PUT',
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
                    toastr.success('Especialidade editada com sucesso!', 'Sucesso');
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