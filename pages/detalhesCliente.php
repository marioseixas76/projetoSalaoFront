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
            <h3><i class="fa-solid fa-user"></i><span class="">&emsp;&emsp;Cliente:
                    <?php echo $data['nome']; ?>
                </span></h3>
            <form class="row mt-2">
                <div class="d-flex">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Id</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['cd_pessoa']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Data Cadastro</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['dataCadastro']; ?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Nome</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['nome']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Data Nascimento</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['dataNascimento']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Email</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['email']; ?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">CPF</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['cpf']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">CNPJ</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['cnpj']; ?>">
                    </div>
                </div>
                <div class="col-auto">
                    <label for="staticEmail2" class="visually label-detalhes">CEP</label>
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                        value="<?php echo $data['cep']; ?>">
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Logradouro</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['logradouro']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Complemento</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['complemento']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Bairro</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['bairro']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Estado</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['estado']; ?>">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Telefone</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['telefone']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Telefone Recado</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['telefoneRecado']; ?>">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually label-detalhes">Status</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="<?php echo $data['status']; ?>">
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>