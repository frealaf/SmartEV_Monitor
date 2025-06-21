<?php
// Inicia sessão e redireciona utilizadores não autenticados ou não administradores
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}
// Proteção extra: só admins podem ver esta página
if ($_SESSION['tipo'] !== 'admin') {
    header('Location: dashboard.php'); // Redireciona para o dashboard se não for admin
    exit();
}
// Define $sensor com valor default
$sensor = isset($_GET['sensor']) ? $_GET['sensor'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SmartEV - Log</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/dashboard.css?id=3">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="dashboard-background">
    <!-- NAVBAR -->
    <nav class="navbar-dashboard">
        <div>
            <img src="img/logo.png" alt="SmartEV Logo" class="navbar-logo">
        </div>
        <div class="navbar-right">
            <a class="nav-link logout-link" href="logout.php">Sair</a>
        </div>
    </nav>
    <!-- CONTEÚDO PRINCIPAL: Histórico de sensores -->
    <div class="container">
        <div class="wrapper-historico">
            <div class="history-card">
                <a href="dashboard.php" class="btn btn-warning mb-4">← Voltar ao Dashboard</a>
                <h3 class="text-warning mb-3">Histórico de: <?= htmlspecialchars($sensor) ?></h3>
                <?php
                // Verifica se foi especificado um sensor para mostrar o histórico
                if (isset($_GET['sensor'])) {
                    $sensor = $_GET['sensor'];
                    $ficheiro = "api/files/" . $_GET['sensor'] . "/log.txt";

                    // Verifica se existe o ficheiro de log para o sensor indicado
                    if (file_exists($ficheiro)) {
                        $linhas = file($ficheiro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                        $total_linhas = count($linhas);

                        $linhas_por_pagina = 10;
                        $pagina_atual = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
                        $offset = ($pagina_atual - 1) * $linhas_por_pagina;

                        $linhas_pagina = array_slice(array_reverse($linhas), $offset, $linhas_por_pagina);

                        echo "<table class='sensor-table'>";
                        echo "<thead><tr><th class='col-title'>Data</th><th class='col-title'>Valor</th></tr></thead>";
                        echo "<tbody>";

                        foreach ($linhas_pagina as $linha) {
                            $valores = preg_split('/[;|]/', trim($linha));
                            if (count($valores) == 2) {
                                // Se for sensor 'camera', traduz o código numérico para uma legenda legível
                                $valor_legenda = $valores[1];
                                if ($sensor === 'camera') {
                                    switch ($valores[1]) {
                                        case '0':
                                            $valor_legenda = 'Nada';
                                            break;
                                        case '1':
                                            $valor_legenda = 'Pessoa';
                                            break;
                                        case '2':
                                            $valor_legenda = 'Sinal Stop';
                                            break;
                                        case '3':
                                            $valor_legenda = 'Nada Detetado';
                                            break;
                                    }
                                }
                                echo "<tr><td class='table-cell'>{$valores[0]}</td><td class='table-cell'>{$valor_legenda}</td></tr>";
                            }
                        }

                        echo "</tbody></table>";

                        // PAGINAÇÃO
                        $total_paginas = ceil($total_linhas / $linhas_por_pagina);
                        echo "<div class='pagination-links'>";
                        for ($i = 1; $i <= $total_paginas; $i++) {
                            $activeClass = ($i == $pagina_atual) ? "btn btn-warning mx-1" : "btn btn-outline-warning mx-1";
                            echo "<a href='?sensor=" . urlencode($sensor) . "&pagina=$i' class='$activeClass'>$i</a> ";
                        }
                        echo "</div>";


                        // Gráfico
                        ?>
                        <?php
                        $labels = array_column(array_map(fn($l) => explode(";", trim($l)), $linhas_pagina), 0);
                        $dados = array_column(array_map(fn($l) => explode(";", trim($l)), $linhas_pagina), 1);
                        ?>
                        <script>
                            const labels = <?php echo json_encode($labels); ?>;
                            const dados = <?php echo json_encode($dados); ?>;
                        </script>
                        <?php
                    } else {
                        echo "<p>Ficheiro não encontrado.</p>";
                    }
                } else {
                    echo "<p>Parâmetro 'sensor' em falta na URL.</p>";
                }
                        ?>
                        </div> <!-- fecha history-card -->
                        <?php if ($sensor === 'camera'): ?>
                            <?php 
                            // Se o sensor for 'camera', inclui o histórico visual de imagens captadas
                            include('historico_imagens.php'); 
                            ?>
                        <?php endif; ?>
                        <div class="card-graph">
                            <div class="card-body">
                                <canvas id="graficoSensor"></canvas>
                            </div>
                        </div> <!-- fecha card-graph -->
            </div> <!-- fecha wrapper-historico -->
        </div> <!-- fecha container -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Geração do gráfico com Chart.js para visualização do histórico -->
        <script>
            const ctx = document.getElementById('graficoSensor')?.getContext('2d');
            if (ctx && typeof labels !== 'undefined' && typeof dados !== 'undefined') {
                const grafico = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Valor do Sensor',
                            data: dados,
                            borderColor: '#FFD700',
                            tension: 0.3,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    color: '#FFFFFF'
                                }
                            }
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Data',
                                    color: '#FFFFFF'
                                },
                                ticks: {
                                    color: '#FFFFFF'
                                }
                            },
                            y: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Valor',
                                    color: '#FFFFFF'
                                },
                                ticks: {
                                    color: '#FFFFFF'
                                }
                            }
                        }
                    }
                });
            }
        </script>
</body>

</html>