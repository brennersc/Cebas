<?php
include_once 'class/Candidato.php';
include_once('class/StatusEnum.php');

$candidato = new Candidato();
$listagemCandidatos = $candidato->buscaCandidatos($_POST);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="vendor/css/bootadmin.min.css">
    <link rel="stylesheet" href="vendor/libraries/datatable/css/datatable.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <title>CEBAS</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <!--  <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>-->
        <a class="navbar-brand" href="#"><img src="img/logo-fumec-vertical-branca.png" style="height:35px"><b>CEBAS</b></a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['name'] ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="login.php?action=logout" class="dropdown-item">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">

        <div class="content p-4">
            <h2 class="mb-4">FILTRO</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST">
                        Perfil:
                        <select size="1" name="perfil">
                            <option value="">Todos</option>
                            <option value="1" <?php if (isset($_POST['perfil']) && $_POST['perfil'] == 1) { echo "selected"; } ?>> Incompatível</option>
                            <option value="2" <?php if (isset($_POST['perfil']) && $_POST['perfil'] == 2) { echo "selected"; } ?>> Pré selecionado</option>
                        </select>

                        Status:
                        <select size="1" name="status">
                            <option value="">Todos</option>
                            <option value="<?php echo (StatusEnum::NaoIniciado) ?>" <?php if (isset($_POST['status']) && $_POST['status'] == StatusEnum::NaoIniciado) { echo "selected"; } ?>> Não inciado</option>
                            <option value="<?php echo (StatusEnum::EmAnalise) ?>" <?php if (isset($_POST['status']) && $_POST['status'] == StatusEnum::EmAnalise) { echo "selected";} ?>> Em análise</option>
                            <option value="<?php echo (StatusEnum::Aprovado) ?>" <?php if (isset($_POST['status']) && $_POST['status'] == StatusEnum::Aprovado) { echo "selected"; } ?>> Aprovado</option>
                            <option value="<?php echo (StatusEnum::Reprovado) ?>" <?php if (isset($_POST['status']) && $_POST['status'] == StatusEnum::Reprovado) { echo "selected"; } ?>> Reprovado</option>
                        </select>
                        <input type="submit" name="filtrar" value="filtrar">
                    </form>
                </div>
            </div>

            <h2 class="mb-4">CANDIDATOS</h2>

            <div class="card mb-4">
                <div class="card-body">
                    <table id="listaInscritos" class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Celular</th>
                                <th>1ª Opção <br />de Curso</th>
                                <th>Deslocamento(Km)</th>
                                <th>Grupo <br />Familiar (Qtde) </th>
                                <th>Renda <br />per capita</th>
                                <th>Data/ hora <br />de inscrição</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($listagemCandidatos as $cand) : ?>

                                <tr>
                                    <?php
                                    $total = $cand->renda_percapta;
                                    $qnt = ($cand->total_familia + 1);
                                    $percapta = ($total / $qnt);

                                    ?>
                                    <td><a href="editar?id=<?php echo $cand->id ?>"><?php echo $cand->id ?></a></td>
                                    <td><?php echo isset($cand->nome) ? $cand->nome : "" ?></td>
                                    <td><?php echo isset($cand->email) ? $cand->email : "" ?></td>
                                    <td><?php echo isset($cand->cpf) ? $cand->cpf : "" ?></td>
                                    <td><?php echo isset($cand->celular) ? $cand->celular : "" ?></td>

                                    <td><?php echo $cand->primeiro ?></td>

                                    <td><?php echo isset($cand->km) ? $cand->km : "" ?></td>
                                    <td><?php echo isset($qnt) ? $qnt : "" ?></td>
                                    <td>R$ <?php echo isset($percapta) ? number_format($percapta, 2, ',', '.') : "" ?></td>
                                    <td><?php echo isset($cand->data_cadastro) ? strftime('%d-%m-%Y %H:%M:%S', strtotime($cand->data_cadastro)) : "" ?></td>

                                    <td>
                                        <?php if ($cand->status == StatusEnum::NaoIniciado) : ?>
                                            <button type="button" class="btn btn-secondary btn-sm" id='buttonStatus<?php echo $cand->id ?>' onclick="callCrudAction('naoiniciado',<?php echo $cand->id ?>);"><i class="fa fa-angle-right"></i> Não Iniciado</button>
                                        <?php elseif ($cand->status == StatusEnum::EmAnalise) : ?>
                                            <button type="button" class="btn btn-warning btn-sm" id='buttonStatus<?php echo $cand->id ?>' onclick="callCrudAction('analise',<?php echo $cand->id ?>);"><i class="fa fa-exclamation-triangle"></i> Em análise</button>
                                        <?php elseif ($cand->status == StatusEnum::Aprovado) : ?>
                                            <button type="button" class="btn btn-success btn-sm" id='buttonStatus<?php echo $cand->id ?>' onclick="callCrudAction('aprovado',<?php echo $cand->id ?>);"><i class="fa fa-check-circle"></i> Aprovado</button>
                                        <?php elseif ($cand->status == StatusEnum::Reprovado) : ?>
                                            <button type="button" class="btn btn-danger btn-sm" id='buttonStatus<?php echo $cand->id ?>' onclick="callCrudAction('reprovado',<?php echo $cand->id ?>);"><i class="fa fa-ban"></i> Reprovado</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="vendor/js/jquery.min.js"></script>
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/js/bootadmin.min.js"></script>
    <script src="vendor/libraries/datatable/js/datatable.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var buttonCommon = {
                exportOptions: {
                    orthogonal: 'export',
                    format: {
                        body: function(data, row, column, node) {
                            return (column === 0 || column === 10) ?
                                $(node).children().text() :
                                data;
                        }
                    }
                }
            };

            $('#listaInscritos').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    search: "Buscar:",
                    lengthMenu: "Exibir _MENU_ registros",
                    info: "Total de registros cadastrados: _TOTAL_",
                    paginate: {
                        first: "Primeiro",
                        previous: "Anterior",
                        next: "Pr&oacute;ximo",
                        last: "&eacute;ltimo"
                    },
                },
                dom: 'Bfrtip',
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copy'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csv'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excel'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdf'
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print'
                    })
                ]
            });
        });



        function callCrudAction(action, id) {
            var acao = action;
            var id = id;
            var buttonStatus = "#buttonStatus" + id;
            var class_button = "";
            var event_onclick = "";
            var button_text = "";


            switch (action) {
                case "naoiniciado":
                    class_button = "btn btn-warning btn-sm";
                    event_onclick = "callCrudAction('analise'," + id + ");"
                    button_text = "<i class='fa fa-exclamation-triangle'></i> Em análise";
                    break;
                case "analise":
                    class_button = "btn btn-success btn-sm";
                    event_onclick = "callCrudAction('aprovado'," + id + ");"
                    button_text = "<i class='fa fa-check-circle'></i> Aprovado";
                    break;
                case "aprovado":
                    class_button = "btn btn-danger btn-sm";
                    event_onclick = "callCrudAction('reprovado'," + id + ");"
                    button_text = "<i class='fa fa-ban'></i> Reprovado";
                    break;
                case "reprovado":
                    class_button = "btn btn-secondary btn-sm";
                    event_onclick = "callCrudAction('naoiniciado'," + id + ");"
                    button_text = "<i class='fa fa-angle-right'></i> Não Iniciado";
                    break;
                default:
                    class_button = "btn btn-secondary btn-sm";
                    event_onclick = "callCrudAction('naoiniciado'," + id + ");"
                    button_text = "<i class='fa fa-angle-right'></i> Não Iniciado";
                    break;
            }

            $.ajax({
                type: "POST",
                url: "include/verificacaoStatus.php",
                dataType: "json",
                data: {
                    acao: action,
                    id: id
                },
                success: function(data) {
                    if (parseInt(data.erro) > 0) {
                        alert(data.mensagem);
                    } else {
                        //aplicando as mudanças!
                        $(buttonStatus).removeClass();
                        $(buttonStatus).addClass(class_button);
                        $(buttonStatus).attr('onclick', event_onclick);
                        $(buttonStatus).html(button_text);
                    }
                },
            });
        }
    </script>


</body>

</html>