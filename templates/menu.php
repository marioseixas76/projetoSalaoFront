<link rel="stylesheet" href="../css/style.css">
<link rel="short icon" href="../img/logo.ico" />

<div class="container-fluid container-menu">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-2.5 min-vh-100" style="background: #DB7598;">
            <div class="d-flex flex-column justify-content-between p-3">
                <a class="d-flex text-decoration-none mt-5 justify-content-center">
                    <img src="../img/bluedryer.png" class="img-fluid logo-salao" alt="Logo salão web" style="width:18%">
                    <span class="d-none d-sm-inline" style="color: #5C4C52; font-weight: 600; font-size:large;">Salão
                        Teste</span>
                </a>
                <ul class="nav nav-pills mt-4 d-flex flex-column justify-content-center">
                    <li class="nav-item">
                        <a href="../pages/agenda.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('agenda.php'); ?>">
                            <i class="fa-solid fa-calendar-days"></i><span class="">Agenda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../pages/clientes.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('clientes.php'); ?>">
                            <i class="fa-solid fa-users"></i><span class="">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-item usuario">
                        <a href="../pages/profissionais.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('profissionais.php'); ?>">
                            <i class="fa-solid fa-users"></i><span class="">Profissionais</span>
                        </a>
                    <li class="nav-item usuario">
                        <a href="../pages/especialidade.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('especialidade.php'); ?>">
                            <i class="fa-solid fa-spa"></i><span class="">Especialidades</span>
                        </a>
                    </li>
                    <li class="nav-item usuario">
                        <a href="../pages/servicos.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('servicos.php'); ?>">
                            <i class="fa-solid fa-suitcase"></i><span class="">Serviços</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('caixa.php'); ?>">
                            <i class="fa-solid fa-cash-register"></i><span class="">Caixa</span>
                        </a>
                    </li>
                    <li class="nav-item usuario gerente">
                        <a href="../pages/usuarios.php"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('usuarios.php'); ?>">
                            <i class="fa-solid fa-users"></i><span class="">Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item usuario">
                        <a href="#"
                            class="nav-link d-flex justify-content-between <?php echo isActivePage('relatorios.php'); ?>">
                            <i class="fa-solid fa-chart-line"></i><span class="">Relatórios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="sair()" href="#"                    
                            class="nav-link d-flex justify-content-between">
                            <i class="fa-solid fa-solid fa-arrow-right-from-bracket"></i><span class="">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
function isActivePage($page)
{
    if (basename($_SERVER['PHP_SELF']) === $page) {
        echo 'active';
    }
}
?>
<script>
    $(document).ready(function () {
        $('.nav-link').click(function () {
            $('.nav-link').removeClass('active'); // Remove a classe "active" de todos os links
            $(this).addClass('active'); // Adiciona a classe "active" ao link clicado
        });
    });

    function sair() {
        localStorage.removeItem('token');
        localStorage.removeItem('cd_pessoa');
        localStorage.removeItem('tipoUsuario');
        localStorage.removeItem('nomeUsuario');

        window.location.href = "http://localhost:81/projetoSalaoFront/";
    }
    
    if (tipoUsuario == 'ROLE_USUARIO') {
        $('.usuario').hide();
    }else if (tipoUsuario == 'ROLE_USUARIO') {
        $('.gerente').hide();
    }
</script>