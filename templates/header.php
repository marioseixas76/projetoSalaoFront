<?php
require_once("footer.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSW</title>
    <link rel="short icon" href="img/logo.ico" />
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<header class="header-usuario">
    <div class="titulo-header">
        <h4><span id="nomeUsuario"></span>&emsp;<i id="iconUsuario" class="" style="color:#DB7598;"></i></h4>
        <h7><span id="tipoUsuario"></span></h7>
    </div>
</header>


<script>



    $(document).ready(function () {

        var indexURL = "http://localhost:81/salaomsw/";

        if (window.location.href != indexURL) {
            var nomeUsuario = localStorage.getItem('nomeUsuario');
            $('#nomeUsuario').text(nomeUsuario);
            $('#iconUsuario').addClass("fa-solid fa-user");

            var tipoUsuario = localStorage.getItem('tipoUsuario');
            if (tipoUsuario == 'ROLE_ADMINISTRADOR') {
                $('#tipoUsuario').text("Administrador");
            } else if (tipoUsuario == 'ROLE_GERENTE') {
                $('#tipoUsuario').text("Gerente");
            } else if (tipoUsuario == 'ROLE_USUARIO') {
                $('#tipoUsuario').text("Usuário");
            }

        }

    });





</script>