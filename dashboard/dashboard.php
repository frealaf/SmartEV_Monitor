<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SynDrive Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-4" style="background-color: #111;">
        <div class="container-fluid justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <img src="../img/estg_color.png" alt="Logo" style="width: 40px;">
                <span class="fs-4 fw-bold text-white">SynDrive</span>
                <a href="../logout.php" class="btn btn-outline-light btn-sm ms-3">Terminar Sessão</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4">
        <!-- Linha dos Sensores -->
        <div class="row">
            <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card temperature-card position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="text-uppercase text-secondary">Temperatura</h4>
                        <i class="mdi mdi-thermometer fs-3 text-danger"></i>
                    </div>
                    <div class="text-secondary mb-1">TEMPERATURA: 24°C</div>
                    <div class="d-flex align-items-baseline mb-2">
                        <span class="display-3 fw-bold text-white">23</span>
                        <span class="fs-1 fw-bold text-white">ºC</span>
                    </div>
                    <div class="text-white text-uppercase fw-semibold mb-3">Estado Normal</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="text-uppercase text-secondary">Humidade</h4>
                        <i class="mdi mdi-water-percent fs-3 text-info"></i>
                    </div>
                    <div class="text-secondary mb-1">HUMIDADE: 50%</div>
                    <div class="d-flex align-items-baseline mb-2">
                        <span class="display-3 fw-bold text-white">50</span>
                        <span class="fs-1 fw-bold text-white">%</span>
                    </div>
                    <div class="text-white text-uppercase fw-semibold mb-3">Estado Normal</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="text-uppercase text-secondary">Pressão</h4>
                        <i class="mdi mdi-weather-windy-variant fs-3 text-primary"></i>
                    </div>
                    <div class="text-secondary mb-1">PRESSÃO: 1013 hPa</div>
                    <div class="d-flex align-items-baseline mb-2">
                        <span class="display-3 fw-bold text-white">1013</span>
                        <span class="fs-1 fw-bold text-white">hPa</span>
                    </div>
                    <div class="text-white text-uppercase fw-semibold mb-3">Estado Normal</div>
                </div>
            </div> 
            <!-- Linha dos Atuadores -->
            <div class="col-md-3 mb-3">
                <div class="card position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="text-uppercase text-secondary">Velocidade</h4>
                        <i class="mdi mdi-speedometer fs-3 text-success"></i>
                    </div>
                    <div class="text-secondary mb-1">VELOCIDADE: -- km/h</div>
                    <div class="d-flex align-items-baseline mb-2">
                        <span class="display-3 fw-bold text-white">--</span>
                        <span class="fs-1 fw-bold text-white">km/h</span>
                    </div>
                    <div class="text-white text-uppercase fw-semibold mb-3">Em Espera</div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card position-relative text-center text-white bg-secondary p-4 h-100">
                    <h4 class="text-uppercase mb-3">Atuador 2</h4>
                    <p>Pronto para implementar</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card position-relative text-center text-white bg-secondary p-4 h-100">
                    <h4 class="text-uppercase mb-3">Atuador 3</h4>
                    <p>Pronto para implementar</p>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tabela de Sensores</h5>
                        <div class="table-responsive">
                            <table class="table table-dark table-borderless align-middle">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Tipo de Dispositivo</th>
                                        <th>Valor</th>
                                        <th>Data de Atualização</th>
                                        <th>Estado Alertas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Temperatura</td>
                                        <td>45°C</td>
                                        <td>2024/03/10 14:31</td>
                                        <td><span class="badge bg-danger px-3 py-2 rounded-pill">Elevada</span></td>
                                    </tr>
                                    <tr>
                                        <td>Humidade</td>
                                        <td>70%</td>
                                        <td>2024/03/10 14:31</td>
                                        <td><span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Moderada</span></td>
                                    </tr>
                                    <tr>
                                        <td>Led Arduino</td>
                                        <td>On</td>
                                        <td>2024/03/10 14:31</td>
                                        <td><span class="badge bg-success px-3 py-2 rounded-pill">Normal</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>