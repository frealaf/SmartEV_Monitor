<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartEV - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/dashboard.css?id=3">
</head>
<body class="dashboard-background">
<nav class="navbar-dashboard">
  <div class="navbar-left">
    <img src="img/logo.png" alt="SynDrive Logo" class="navbar-logo">
  </div>
  <div class="navbar-right">
    <a class="nav-link logout-link" href="logout.php">
        <i class="mdi mdi-logout"></i> Terminar Sessão
    </a>
  </div>
</nav>
<header class="project-title">
    <h1>SmartEV Monitor</h1>
</header>
    <div class="container mb-5">
        <h2 class="section-title mt-5">Sensores</h2>
        <hr class="section-divider">
        <div class="row">
            <!-- sensores -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">POTÊNCIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            $velocidade = @file_get_contents("api/files/potencia/valor.txt");
                            echo $velocidade ? htmlspecialchars(trim($velocidade)) . ' km/h' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-speedometer"></i>
                    </div>
                    <p class="sensor-description">Velocidade atual do veículo</p>
                    <a href="historico.php?sensor=potencia" class="btn-warning">Histórico</a>
                    <?php
                    $hora_potencia = @file_get_contents("api/files/potencia/hora.txt");
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">TEMPERATURA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            $temperatura = @file_get_contents("api/files/temperatura/valor.txt");
                            echo $temperatura ? htmlspecialchars(trim($temperatura)) . ' °C' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-thermometer"></i>
                    </div>
                    <p class="sensor-description">Temperatura atual da bateria</p>
                    <a href="historico.php?sensor=temperatura" class="btn-warning">Histórico</a>
                    <?php
                    $hora_temperatura = @file_get_contents("api/files/temperatura/hora.txt");
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">CARGA DA BATERIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            $bateria = @file_get_contents("api/files/bateria/valor.txt");
                            echo $bateria ? htmlspecialchars(trim($bateria)) . '%' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-battery-80"></i>
                    </div>
                    <p class="sensor-description">Carga atual da bateria</p>
                    <a href="historico.php?sensor=bateria" class="btn-warning">Histórico</a>
                    <?php
                    $hora_bateria = @file_get_contents("api/files/bateria/hora.txt");
                    ?>
                </div>
            </div>
        </div>

        <h2 class="section-title mt-5">Atuadores</h2>
        <hr class="section-divider">
        <div class="row">
            <!-- atuadores -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">SENSOR DE DISTÂNCIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value"> 5 Metros</span>
                        <i class="mdi mdi-ruler"></i>
                    </div>
                    <p class="sensor-description">Distância atual do veículo da frente</p>
                    <a href="historico.php?sensor=distancia" class="btn-warning">Histórico</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">SEGURANÇA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">Trancado</span>
                        <i class="mdi mdi-lock"></i>
                    </div>
                    <p class="sensor-description">Estado atual da porta</p>
                    <a href="historico.php?sensor=seguranca" class="btn-warning">Histórico</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">LUZES</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value"> Ligadas</span>
                        <i class="mdi mdi-car-parking-lights"></i>
                    </div>
                    <p class="sensor-description">Estado atual da luminosidade</p>
                    <a href="historico.php?sensor=luzes" class="btn-warning">Histórico</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>