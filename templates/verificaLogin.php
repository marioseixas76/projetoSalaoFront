<script>
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "../";
    }

    const cd_pessoa = localStorage.getItem('cd_pessoa');

    var tipoUsuario = localStorage.getItem('tipoUsuario');

    if (tipoUsuario == 'ROLE_GERENTE') {
        $('.addUser').hide();
    } else if (tipoUsuario == 'ROLE_USUARIO') {
        $('#tipoUsuario').text("Usuário");
    }
</script>