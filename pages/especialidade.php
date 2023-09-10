<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


$url = 'http://localhost/api/especialidade';
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
            <h1><i class="fa-solid fa-spa"></i><span class="">&emsp;&emsp;Especialidades</span></h1>
            <table class="table table-listagem">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Especialidade</th>
                        <th scope="col">Ações&emsp;&emsp;<a href="cadastroEspecialidade.php"><i
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
                                <?php echo $item['nome'] ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="editarEspecialidade.php?id=<?php echo $item['id']; ?>"><i
                                            class="fa-solid fa-pen-to-square me-2" style="color:orange"></i></a>
                                    <a href="#" onclick="excluir(<?php echo $item['id']; ?>)"><i class="fa-solid fa-trash gerente"
                                            style="color:red"></i></a>
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
            url: 'http://localhost/api/especialidade/' + id,
            method: 'DELETE',
            success: function (response) {
                toastr.success('Cliente deletado com sucesso!', 'Sucesso');
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
        $('#tipoUsuario').text("Usuário");
    }
</script>