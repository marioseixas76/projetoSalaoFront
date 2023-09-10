<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


if (isset($_GET['id'])) {
    $clienteId = $_GET['id'];
} else {
    echo "Cliente não encontrado.";
}

$url = 'http://localhost/api/cliente/' . $clienteId;
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
            <h3><i class="fa-solid fa-user"></i><span class="">Cliente:
                    <?php echo $data['nome']; ?>
                </span></h3>
            <form class="row g-3 form-cadastro mt-2" id="form-editar-cliente">
                <div class="d-flex">
                    <div class="col-md-4 me-3">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="nome" value="<?php echo $data['nome']; ?>">
                    </div>

                    <div class="col-md-4 me-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" value="<?php echo $data['email']; ?>">
                    </div>

                </div>

                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" value="<?php echo $data['cep']; ?>">
                    </div>

                    <div class="col-md-4 me-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro"
                            value="<?php echo $data['logradouro']; ?>">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento"
                            value="<?php echo $data['complemento']; ?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" value="<?php echo $data['bairro']; ?>">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" value="<?php echo $data['cidade']; ?>">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" value="<?php echo $data['estado']; ?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" value="<?php echo $data['telefone']; ?>">
                    </div>
                    <div class="col-md-2 me-3">
                        <label for="telefoneRecado" class="form-label">Telefone Recado</label>
                        <input type="text" class="form-control" id="telefoneRecado"
                            value="<?php echo $data['telefoneRecado']; ?>">
                    </div>
                    <div class="col-md-2 me-3">
                        <label class="form-check-label" for="whatsApp">
                            WhatsApp
                        </label>
                        <input class="form-check-input" type="checkbox" id="whatsApp">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary botao-login">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {


        $("#form-editar-cliente").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: 'http://localhost:80/api/cliente/<?php echo $data['cd_pessoa']; ?>',
                method: 'PUT',
                data: JSON.stringify({
                    cep: $('#cep').val(),
                    logradouro: $('#logradouro').val(),
                    complemento: $('#complemento').val(),
                    bairro: $('#bairro').val(),
                    cidade: $('#cidade').val(),
                    estado: $('#estado').val(),
                    telefone: $('#telefone').val(),
                    telefoneRecado: $('#telefoneRecado').val(),
                    email: $('#email').val(),

                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Cliente editado com sucesso!', 'Sucesso');
                    window.location.href = "clientes.php";
                },
                error: function () {
                    $('#mensagem').text('Erro ao processar a requisição.');
                }
            })
        })

    });

</script>