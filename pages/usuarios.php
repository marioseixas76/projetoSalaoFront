<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


$url = 'http://localhost/api/usuario';
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
            <h1><i class="fa-solid fa-users"></i><span class="">Usuários</span></h1>
            <table class="table table-listagem">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipo Usuário</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações&emsp;&emsp;<a href="cadastroUsuario.php"><i
                                    class="fa-solid fa-user-plus gerente" style="color:#DB7598;"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td>
                                <?php echo $item['cd_pessoa'] ?>
                            </td>
                            <td>
                                <?php echo $item['nome'] ?>
                            </td>
                            <td>
                                <?php echo $item['telefone'] ?>
                            </td>
                            <td>
                                <?php echo $item['email'] ?>
                            </td>
                            <td>
                                <?php echo $item['authority']; ?>
                            </td>
                            <td>
                                <?php echo $item['status']; ?>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="detalhesUsuario.php?id=<?php echo $item['cd_pessoa']; ?>"><i
                                            class="fa-solid fa-eye" style="color:#DB7598;"></i></a>
                                    <a href="editarUsuario.php?id=<?php echo $item['cd_pessoa']; ?>"><i
                                            class="fa-solid fa-pen-to-square gerente" style="color:orange"></i></a>
                                    <a href="#" onclick="excluir(<?php echo $item['cd_pessoa']; ?>)"><i
                                            class="fa-solid fa-trash gerente" style="color:red"></i></a>
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
            url: 'http://localhost/api/usuario/' + id,
            method: 'DELETE',
            success: function (response) {
                toastr.success('Cliente deletado com sucesso!', 'Sucesso');
                location.reload();
            },
            error: function () {
                $('#mensagem').text('Erro ao processar a requisição.');
            }
        })
    }
    var tipoUsuario = localStorage.getItem('tipoUsuario');

    if (tipoUsuario == 'ROLE_GERENTE') {
        $('.gerente').hide();
    } else if (tipoUsuario == 'ROLE_USUARIO') {
        $('#tipoUsuario').text("Usuário");
    }
</script>