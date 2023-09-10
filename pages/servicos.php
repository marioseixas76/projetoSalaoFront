<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


$url = 'http://localhost/api/servico';
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
            <h1><i class="fa-solid fa-suitcase"></i><span class="">&emsp;&emsp;Serviços</span></h1>
            <table class="table table-listagem">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Serviço</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações&emsp;&emsp;<a href="cadastroServico.php"><i
                                    class="fa-solid fa-circle-plus" style="color:#DB7598;"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td>
                                <?php echo $item['id'] ?>
                            </td>
                            <td>
                                <?php echo $item['ds_servico'] ?>
                            </td>
                            <td>
                                <?php echo $item['vl_servico'] ?>
                            </td>
                            <td>
                                <?php echo $item['status'] ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="editarServico.php?id=<?php echo $item['id']; ?>"><i
                                            class="fa-solid fa-pen-to-square me-2" style="color:orange"></i></a>
                                    <a href="#" onclick="excluir(<?php echo $item['id']; ?>)"><i
                                            class="fa-solid fa-trash gerente usuario" style="color:red"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function excluir(id) {
        $.ajax({
            url: 'http://localhost/api/servico/' + id,
            method: 'DELETE',
            success: function (response) {
                toastr.success('Serviço deletado com sucesso!', 'Sucesso');
            },
            error: function () {
                $('#mensagem').text('Erro ao processar a requisição.');
            }
        })
        location.reload();
    }

    if (tipoUsuario == 'ROLE_GERENTE') {
        $('.gerente').hide();
    } else if (tipoUsuario == 'ROLE_USUARIO') {
        $('.usuario').hide();
    }

</script>