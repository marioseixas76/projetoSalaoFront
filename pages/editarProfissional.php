<?php
require_once("../templates/footer.php");
include_once("../templates/verificaLogin.php");


if (isset($_GET['id'])) {
    $profissionalId = $_GET['id'];
} else {
    echo "Profissional não encontrado.";
}

$url = 'http://localhost/api/profissional/' . $profissionalId;
$response = file_get_contents($url);
$data = json_decode($response, true);

$urlEspecialidade = 'http://localhost/api/especialidade/' . $data['cd_especialidade'];
$responseEspecialidade = file_get_contents($urlEspecialidade);
$dataEspecialidade = json_decode($responseEspecialidade, true);
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
            <h1><i class="fa-solid fa-calendar-days"></i><span class="">&emsp;&emsp;Editar Profissional</span></h1>
            <form class="row g-3 form-cadastro" id="form-editar-profissional">
                <div class="d-flex">
                    <div class="col-md-2 me-3" id="campo-especialidade">
                        <label for="especialidade" class="form-label">Especialidade</label>
                        <select id="especialidade" name="especialidade" class="form-select" name="especialidade">
                            <option value="<?php echo $data['cd_especialidade']; ?>"><?php echo $dataEspecialidade['nome']; ?></option>
                        </select>
                    </div>
                </div>

                <div class="d-flex">

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

                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>

    $(document).ready(function () {


        $.ajax({
            url: 'http://localhost/api/especialidade',
            method: 'GET',
            success: function (response) {
                // Preencher as opções do select com base nos dados retornados
                var select = $('#especialidade');
                select.append($('<option>', {
                    value: '', // Valor vazio para a opção "Selecione..."
                    text: 'Selecione...'
                }));

                // Preencher as opções do select com base nos dados retornados
                $.each(response, function (index, especialidade) {
                    select.append($('<option>', {
                        value: especialidade.id,
                        text: especialidade.nome
                    }));
                });
            },
            error: function () {
                console.log('Erro ao obter as especialidades.');
            }

        })


        $("#form-editar-profissional").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: 'http://localhost:80/api/profissional/<?php echo $data['cd_pessoa']; ?>',
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
                    cd_especialidade: $('#especialidade').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Profissional editado com sucesso!', 'Sucesso');
                    window.location.href = "profissionais.php";
                },
                error: function () {
                    $('#mensagem').text('Erro ao processar a requisição.');
                }
            })
        })

    });

</script>

</html>