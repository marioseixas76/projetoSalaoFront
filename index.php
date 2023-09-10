<?php
require_once("templates/header.php");
require_once("templates/footer.php");

?>
<link rel="stylesheet" href="css/style.css">


<body class="body-index">
    <div class="card card-login">
        <div class="row">
            <div class="col-md-4 card-logo">
                <img src="img/logo.png" class="img-fluid logo-salao" alt="Logo salão web" style="width:85%">
                <h2 class="texto-logo">Meu salão na Web</h2>
            </div>
            <div class="col-md-8 form-login">
                <form class="col-md-6 box-login">
                    <div class="d-flex justify-content-center">
                        <h4 style="color: #DB7598">ACESSE&ensp;</h4>
                        <h4>SUA&ensp;CONTA</h4>
                    </div>
                    <div class="col-auto">
                        <label for="email-login" class="control">Email</label>
                        <input type="text" class="form-control" id="email-login" placeholder="email@example.com">
                    </div>
                    <!-- <div class="col-auto">
                        <label for="senha-login" class="control">Senha</label>
                        <input type="password" class="form-control" id="senha-login" placeholder="Senha">
                    </div> -->
                    <div class="col-auto">
                        <label for="senha-login" class="control">Senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="senha-login" placeholder="Senha">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="toggle-password"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a>
                            <button class="btn btn-primary btn-submit mb-3 mt-3 botao-login" type="submit">
                                Entrar
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function () {

        // Seleciona o ícone de alternância de senha
        var togglePassword = $("#toggle-password");
        // Seleciona o campo de senha
        var passwordField = $("#senha-login");

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
        $('.botao-login').click(function (e) {
            e.preventDefault();

            var email = $('#email-login').val();
            var senha = $('#senha-login').val();

            $.ajax({
                type: 'POST',
                url: 'http://localhost/api/login',
                data: JSON.stringify({
                    email: email,
                    senha: senha
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response, textStatus, xhr) {
                    if (xhr.status === 200) { // Verifica o status da resposta
                        toastr.success('Login efetuado com sucesso!', 'Sucesso');
                        localStorage.setItem('token', response.token);
                        localStorage.setItem('cd_pessoa', response.cd_pessoa);
                        localStorage.setItem('tipoUsuario', response.tipoUsuario);
                        localStorage.setItem('nomeUsuario', response.nomeUsuario);
                        window.location.href = 'pages/agenda.php';
                    } else {
                        alert('Login inválido. Verifique suas credenciais.');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    if (xhr.status === 401) {
                        alert('Credenciais inválidas. Verifique o email e a senha.');
                    } else {
                        alert('Fale com o administrador da página.');
                    }
                }
            });
        });
    });



</script>