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
            <h1><i class="fa-solid fa-calendar-days"></i><span class="">&emsp;&emsp;Cadastro Usuário</span></h1>
            <form class="row g-3 form-cadastro" id="form-cadastro-usuario">
                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label class="form-label" for="tipo">Tipo de pessoa</label>
                        <select class="form-select" id="tipo" name="tipo">
                            <option selected>Seleciona...</option>
                            <option value="cpf">Pessoa Física</option>
                            <option value="cnpj">Pessoa Jurídica</option>
                        </select>
                    </div>

                    <div class="col-md-2 me-3" id="campo-cpf" style="display: none;">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf">
                    </div>
                    <div class="col-md-2 me-3" id="campo-nascimento" style="display: none;">
                        <label for="nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento">
                    </div>

                    <div class="col-md-2 me-3" id="campo-cnpj" style="display: none;">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj">
                    </div>
                    <div class="col-md-2 me-3" id="campo-usuario">
                        <label for="usuario" class="form-label">Tipo Usuário</label>
                        <select id="usuario" name="usuario" class="form-select">
                            <option value="ROLE_USUARIO">Usuário</option>
                            <option value="ROLE_GERENTE">Gerente</option>
                            <option value="ROLE_ADMINISTRADOR">Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-4 me-3">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="nome">
                    </div>

                    <div class="col-md-4 me-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>

                <div class="d-flex">
                    <div class="col-md-4 me-3">
                        <label for="senha-login" class="control">Senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha-login" placeholder="Senha">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="toggle-password"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 me-3">
                        <label for="confirmar-senha" class="control">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar-senha" placeholder="Confirmar Senha">
                    </div>
                    <div id="senha-error" class="text-danger"></div>
                </div>



                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep">
                    </div>

                    <div class="col-md-4 me-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade">
                    </div>

                    <div class="col-md-2 me-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-md-2 me-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone">
                    </div>
                    <div class="col-md-2 me-3">
                        <label for="telefoneRecado" class="form-label">Telefone Recado</label>
                        <input type="text" class="form-control" id="telefoneRecado">
                    </div>
                    <div class="col-md-2 me-3">
                        <label class="form-check-label" for="whatsApp">
                            WhatsApp
                        </label>
                        <input class="form-check-input" type="checkbox" id="whatsApp">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary botao-login">Cadastrar</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        $('#tipo').change(function () {
            var tipoSelecionado = $(this).val();

            if (tipoSelecionado === 'cpf') {
                $('#campo-cpf').show();
                $('#campo-nascimento').show();
                $('#campo-cnpj').hide();
            } else if (tipoSelecionado === 'cnpj') {
                $('#campo-cnpj').show();
                $('#campo-cpf').hide();
                $('#campo-nascimento').hide();
            }
        });

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

        // if (validatePassword() && validateConfirmPassword()) {
            $("#form-cadastro-usuario").submit(function (event) {
                event.preventDefault();

                var dataNascimentoInput = $('#dataNascimento').val();
                var parts = dataNascimentoInput.split('-');
                var dataNascimento = `${parts[2]}-${parts[1]}-${parts[0]}`;

                $.ajax({
                    url: 'http://localhost:80/api/usuario',
                    method: 'POST',
                    data: JSON.stringify({
                        nome: $('#nome').val(),
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
                        cpf: $('#cpf').val(),
                        cnpj: $('#cnpj').val(),
                        dataNascimento: dataNascimento,
                        authority: $('#usuario').val(),
                        senha: $('#senha-login').val()
                    }),
                    contentType: 'application/json',
                    crossDomain: true,
                    xhrFields: {
                        withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                    },
                    success: function (response) {
                        toastr.success('Novo profissional cadastrado com sucesso!', 'Sucesso');
                        window.location.href = "usuarios.php";
                    },
                    error: function () {
                        $('#mensagem').text('Erro ao processar a requisição.');
                    }
                })
            })
        // }else {
        //     alert('Por favor, corrija os erros no formulário antes de enviar.');
        // }

    });

</script>

</html>