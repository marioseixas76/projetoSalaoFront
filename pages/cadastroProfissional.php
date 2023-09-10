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
            <h1><i class="fa-solid fa-calendar-days"></i><span class="">&emsp;&emsp;Cadastro Profissional</span></h1>
            <form class="row g-3 form-cadastro" id="form-cadastro-cliente">
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
                    <div class="col-md-2 me-3" id="campo-especialidade">
                        <label for="especialidade" class="form-label">Especialidade</label>
                        <select id="especialidade" name="especialidade" class="form-select" name="especialidade">
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

        $.ajax({
            url: 'http://localhost/api/especialidade',
            method: 'GET',
            success: function (response) {
                // Preencher as opções do select com base nos dados retornados
                var select = $('#especialidade');
                select.empty(); // Limpa as opções anteriores, se houver
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

        $("#form-cadastro-cliente").submit(function (event) {
            event.preventDefault();

            var dataNascimentoInput = $('#dataNascimento').val();
            var parts = dataNascimentoInput.split('-');
            var dataNascimento = `${parts[2]}-${parts[1]}-${parts[0]}`;

            $.ajax({
                url: 'http://localhost:80/api/profissional',
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
                    cd_especialidade: $('#especialidade').val()
                }),
                contentType: 'application/json',
                crossDomain: true,
                xhrFields: {
                    withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
                },
                success: function (response) {
                    toastr.success('Novo profissional cadastrado com sucesso!', 'Sucesso');
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