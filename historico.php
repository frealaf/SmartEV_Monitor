<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SynDrive Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/dashboard.css?id=6">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="dashboard-background">
<nav class="navbar-dashboard">
  <div>
    <img src="img/logo.png" alt="SynDrive Logo" class="navbar-logo">
  </div>
  <div class="navbar-right">
    <a class="nav-link logout-link" href="logout.php">Sair</a>
  </div>
</nav>
<div class="container">
    <div class="wrapper-historico">
        <div class="history-card">
            <a href="dashboard.php" class="btn btn-warning mb-4">← Voltar ao Dashboard</a>
            <?php
            if (isset($_GET['sensor'])) {
                $ficheiro = "api/files/" . $_GET['sensor'] . "/log.txt";

                if (file_exists($ficheiro)) {
                    echo "<table class='sensor-table'>";
                    echo "<thead><tr><th class='col-title'>Data</th><th class='col-title'>Valor</th></tr></thead>";
                    echo "<tbody>";

                    $fp = fopen($ficheiro, "r");
                    while (($linha = fgets($fp)) !== false) {
                        $valores = explode(";", trim($linha));
                        if (count($valores) == 2) {
                            echo "<tr><td class='table-cell'>{$valores[0]}</td><td class='table-cell'>{$valores[1]}</td></tr>";
                        }
                    }
                    fclose($fp);

                    echo "</tbody></table>";

                    ?>
                    <script>
                        const labels = <?php echo json_encode(array_column(array_map(fn($l) => explode(";", trim($l)), file($ficheiro)), 0)); ?>;
                        const dados = <?php echo json_encode(array_map('floatval', array_column(array_map(fn($l) => explode(";", trim($l)), file($ficheiro)), 1))); ?>;
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
        <div class="grafico-card">
            <canvas id="graficoSensor"></canvas>
        </div>
    </div> <!-- fecha wrapper-historico -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                        title: { display: true, text: 'Data', color: '#FFFFFF' },
                        ticks: { color: '#FFFFFF' }
                    },
                    y: {
                        display: true,
                        title: { display: true, text: 'Valor', color: '#FFFFFF' },
                        ticks: { color: '#FFFFFF' }
                    }
                }
            }
        });
    }
</script>
</body>
</html>