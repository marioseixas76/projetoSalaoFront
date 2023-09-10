<?php
require_once("../templates/header.php");
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


if (isset($_GET['id'])) {
    $usuarioId = $_GET['id'];
} else {
    echo "Usuário não encontrado.";
}

$url = 'http://localhost/api/usuario/' . $usuarioId;
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
            <h1><i class="fa-solid fa-calendar-days"></i><span class="">&emsp;&emsp;Editar Usuário</span></h1>
            <form class="row g-3 form-cadastro" id="form-cadastro-usuario">


                <div class="d-flex">
                    <div class="col-md-4 me-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" value="<?php echo $data['email']; ?>">
                    </div>
                    <div class="col-md-2 me-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected value="<?php echo $data['status']; ?>"><?php echo $data['status']; ?></option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex">

                    <div class="col-md-4 me-3">
                        <label for="senha-login" class="control">Nova Senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha-login" placeholder="Senha">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="toggle-password"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 me-3">
                        <label for="confirmar-senha" class="control">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" id="confirmar-senha" placeholder="Confirmar Senha">
                    </div>
                    <div id="senha-error" class="text-danger"></div>
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
                    <button type="submit" class="btn btn-primary botao-login">Editar</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        // Seleciona os campos de senha e confirmação de senha
        var passwordField = $("#senha-login");
        var confirmPasswordField = $("#confirmar-senha");

        // Seleciona o elemento de erro
        var senhaError = $("#senha-error");

        // Seleciona o ícone de alternância de senha
        var togglePassword = $("#toggle-password");

        // Adiciona um evento de clique ao ícone de alternância de senha
        togglePassword.click(function () {
            // Alterna entre os tipos de campo de senha (password/text)
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                togglePassword.addClass("fa-eye-slash");
                togglePassword.removeClass("fa-eye");
            } else {
                passwordField.attr("type", "password");
                togglePassword.removeClass("fa-eye-slash");
                togglePassword.addClass("fa-eye");
            }
        });

        // Adiciona um evento de validação de senha ao perder o foco
        passwordField.blur(validatePassword);

        // Adiciona um evento de validação de confirmação de senha ao perder o foco
        confirmPasswordField.blur(validateConfirmPassword);

        function validatePassword() {
            var password = passwordField.val();
            // Regex para verificar se a senha atende aos critérios
            var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+]).{6,}$/;

            if (passwordRegex.test(password)) {
                senhaError.text("");
                return true;
            } else {
                senhaError.text("A senha deve conter pelo menos 6 caracteres, um número, uma letra maiúscula, uma letra minúscula e um caractere especial.");
                return false;
            }
        }

        function validateConfirmPassword() {
            var password = passwordField.val();
            var confirmPassword = confirmPasswordField.val();

            if (password === confirmPassword) {
                senhaError.text("");
                return true;
            } else {
                senhaError.text("As senhas não coincidem.");
                return false;
            }
        }


        $("#form-cadastro-usuario").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: 'http://localhost:80/api/usuario/<?php echo $data['cd_pessoa']; ?>',
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
                    whatsApp: $('#whatsApp').is(':checked'),
                    senha: $('#senha-login').val(),
                    status: $('#status').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Usuário editado com sucesso!', 'Sucesso');
                    window.location.href = "usuarios.php";
                },
                error: function () {
                    $('#mensagem').text('Erro ao processar a requisição.');
                }
            })
        })

    });

</script>

</html>