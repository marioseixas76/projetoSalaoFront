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
            <div>
                <?php
                include_once("../templates/header.php");
                ?>
            </div>
            <h1><i class="fa-solid fa-calendar-days"></i><span class="">&emsp;&emsp;Agenda</span></h1>
            <html>
            <div class="d-flex mb-2">
                <button id="anterior" class="btn btn-primary botao-login">Anterior</button>&emsp;&emsp;
                <h4><span id="data-selecionada"></span></h4>
                &emsp;&emsp;<button id="proximo" class="btn btn-primary botao-login">Próximo</button>
            </div>


            <body>
                <div class="container">
                    <div id="agenda-container" class=""></div>
                </div>
            </body>
            <div class="modal fade" id="agendamentoModal" tabindex="-1" role="dialog"
                aria-labelledby="agendamentoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agendamentoModalLabel">Agendar Horário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Conteúdo do formulário de agendamento -->
                            <form id="agendamentoForm">
                                <div class="form-group formulario-agendamento">
                                    <div class="col-md-2 me-3">
                                        <label for="cliente" class="form-label">Cliente:</label>
                                        <select id="cliente" name="cliente" class="form-select">
                                        </select>
                                    </div>
                                    <div class="col-md-2 me-3">
                                        <label for="servico" class="form-label">Serviço:</label>
                                        <select id="servico" name="servico" class="form-select">
                                        </select>
                                    </div>
                                </div>

                                <!-- Outros campos do formulário -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary botao-login" onclick="salvar()">Agendar</button>
                        </div>
                    </div>
                </div>
            </div>


            </html>

        </div>
    </div>
</div>


<script>


    $(document).ready(function () {

        function preencherAgendaParaDia(dataSelecionada) {
            $('#data-selecionada').text(dataSelecionada.format('DD-MM-YYYY'));
            const dataSelecionadaNova = dataSelecionada.format('DD-MM-YYYY');
            $('#agenda-container').empty();
            $.ajax({
                url: 'http://localhost/api/cliente',
                method: 'GET',
                success: function (response) {
                    // Preencher as opções do select com base nos dados retornados
                    var select = $('#cliente');
                    select.empty(); // Limpa as opções anteriores, se houver
                    select.append($('<option>', {
                        value: '', // Valor vazio para a opção "Selecione..."
                        text: 'Selecione...'
                    }));

                    // Preencher as opções do select com base nos dados retornados
                    $.each(response, function (index, cliente) {
                        select.append($('<option>', {
                            value: cliente.cd_pessoa,
                            text: cliente.nome
                        }));
                    });
                },
                error: function () {
                    console.log('Erro ao obter as especialidades.');
                }

            })

            $.ajax({
                url: 'http://localhost/api/cliente',
                method: 'GET',
                success: function (response) {
                    // Preencher as opções do select com base nos dados retornados
                    var select = $('#cliente');
                    select.empty(); // Limpa as opções anteriores, se houver
                    select.append($('<option>', {
                        value: '', // Valor vazio para a opção "Selecione..."
                        text: 'Selecione...'
                    }));

                    // Preencher as opções do select com base nos dados retornados
                    $.each(response, function (index, cliente) {
                        select.append($('<option>', {
                            value: cliente.cd_pessoa,
                            text: cliente.nome
                        }));
                    });
                },
                error: function () {
                    console.log('Erro ao obter as especialidades.');
                }

            })
            $.ajax({
                url: 'http://localhost/api/servico',
                method: 'GET',
                success: function (response) {
                    // Preencher as opções do select com base nos dados retornados
                    var select = $('#servico');
                    select.empty(); // Limpa as opções anteriores, se houver
                    select.append($('<option>', {
                        value: '', // Valor vazio para a opção "Selecione..."
                        text: 'Selecione...'
                    }));

                    // Preencher as opções do select com base nos dados retornados
                    $.each(response, function (index, servico) {
                        select.append($('<option>', {
                            value: servico.id,
                            text: servico.ds_servico
                        }));
                    });
                },
                error: function () {
                    console.log('Erro ao obter as especialidades.');
                }

            })
            $.get('http://localhost/api/agenda', function (agenda) {

                $.get('http://localhost/api/profissional', function (profissionais) {

                    const container = $('#agenda-container');
                    const table = $('<table>').addClass('table table-bordered');
                    const tableHeader = $('<thead>').append($('<tr>'));

                    // Criação do cabeçalho da tabela com os dias da semana
                    tableHeader.find('tr').append($('<th>').text('Horário'));

                    profissionais.forEach(profissional => {

                        tableHeader.find('tr').append($('<th>').text(profissional.nome));
                    });

                    table.append(tableHeader);

                    const tableBody = $('<tbody>');

                    // Criação das linhas de horários
                    for (let hora = 9; hora <= 18; hora++) {

                        const horarioRow = $('<tr>');
                        const horarioHeader = $('<th>').text(hora + ':00');
                        horarioRow.append(horarioHeader);
                        profissionais.forEach(profissional => {

                            const horarioCell = $('<td>');
                            horarioCell.attr('data-profissional', profissional.cd_pessoa); // Adicione este atributo
                            horarioCell.attr('data-hora', hora + ':00'); // Adicione este atributo
                            horarioCell.attr('data-data', dataSelecionadaNova); // Adicione este atributo
                            horarioRow.append(horarioCell);

                        });

                        tableBody.append(horarioRow);
                    }

                    table.append(tableBody);
                    container.append(table);

                    $.get('http://localhost/api/agenda', function (agendamentos) {
                        agendamentos.forEach(function (agendamento) {
                            const profissionalAgendamento = agendamento.cd_profissional;
                            const horaAgendamento = agendamento.horario;
                            const dataAgendamento = moment(agendamento.data);

                            const formattedData = dataAgendamento.format('DD-MM-YYYY');
                            const formattedHora = horaAgendamento.slice(0, 5);

                            const celula = $(`td[data-profissional="${profissionalAgendamento}"][data-hora="${formattedHora}"][data-data="${formattedData}"]`);

                            // Chamada AJAX para obter nome do cliente pelo ID
                            $.ajax({
                                url: `http://localhost/api/cliente/${agendamento.cd_cliente}`,
                                method: 'GET',
                                success: function (cliente) {
                                    // Chamada AJAX para obter nome do serviço pelo ID
                                    $.ajax({
                                        url: `http://localhost/api/servico/${agendamento.cd_servico}`,
                                        method: 'GET',
                                        success: function (servico) {
                                            // Preencher a célula com os dados do agendamento
                                            if (celula.length > 0) {
                                                celula.text(`${cliente.nome} - ${servico.ds_servico}`);
                                            }
                                        },
                                        error: function () {
                                            console.log('Erro ao obter o serviço.');
                                        }
                                    });
                                },
                                error: function () {
                                    console.log('Erro ao obter o cliente.');
                                }
                            });
                        });
                    });




                    let dataSelecionadaAntesDoModal;

                    $('td').on('click', function () {
                        console.log("Célula da agenda clicada.");

                        const profissional = $(this).data('profissional');
                        const hora = $(this).data('hora');
                        dataSelecionadaAntesDoModal = $(this).data('data'); // Armazena a data antes de abrir o modal

                        // Preencha o modal com os dados relevantes para o agendamento
                        $('#agendamentoModalLabel').text(`Agendar horário às ${hora} do dia ${dataSelecionadaNova}`);

                        $('#agendamentoModal').attr('data-profissional-modal', profissional);
                        $('#agendamentoModal').attr('data-hora-modal', hora);

                        // Abra o modal
                        $('#agendamentoModal').modal('show');
                        $('#agendamentoModal').off('shown.bs.modal').on('shown.bs.modal', function () {
                            $('#agendamentoModal').attr('data-profissional-modal', profissional);
                            $('#agendamentoModal').attr('data-hora-modal', hora);
                            $('#agendamentoModal').attr('data-data-selecionada', dataAtual.format('DD-MM-YYYY'));
                        });

                    });

                });

            });
        }



        var dataAtual = moment();
        preencherAgendaParaDia(dataAtual);

        // Botões para navegar entre os dias
        $('#anterior').click(function () {
            dataAtual.subtract(1, 'days');
            preencherAgendaParaDia(dataAtual);
        });

        $('#proximo').click(function () {
            dataAtual.add(1, 'days');
            preencherAgendaParaDia(dataAtual);
        });
    });

    function salvar() {

        event.preventDefault();

        const profissional = $('#agendamentoModal').attr('data-profissional-modal');
        const hora = $('#agendamentoModal').attr('data-hora-modal');
        const dataSelecionada = $('#agendamentoModal').attr('data-data-selecionada');
        const dataFormatada = moment(dataSelecionada, 'DD-MM-YYYY').format('YYYY-MM-DD');


        $.ajax({
            url: 'http://localhost:80/api/agenda',
            method: 'POST',
            data: JSON.stringify({
                cd_cliente: $('#cliente').val(),
                cd_profissional: profissional,
                cd_servico: $('#servico').val(),
                data: dataFormatada,
                horario: hora
            }),
            contentType: 'application/json',
            crossDomain: true,
            xhrFields: {
                withCredentials: true // Permite o envio de cookies e cabeçalhos personalizados (como o 'Authorization')
            },
            success: function (response) {
                toastr.success('Agendamento cadastrado com sucesso!', 'Sucesso');
                $('#agendamentoModal').modal('hide'); // Fecha o modal
                setTimeout(function () {
                    preencherAgendaParaDia(moment(dataSelecionadaAntesDoModal, 'DD-MM-YYYY')); // Preenche a agenda novamente
                }, 500);
            },
            error: function () {
                $('#mensagem').text('Erro ao processar a requisição.');
            }
        });
    }




</script>