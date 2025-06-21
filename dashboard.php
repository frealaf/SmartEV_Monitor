<?php
// Inicia a sessão e redireciona se o utilizador não estiver autenticado
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SmartEV - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/dashboard.css?id=6">
</head>



<body class="dashboard-background">
    <!-- NAVBAR -->
    <nav class="navbar-dashboard">
        <div class="navbar-left">
            <img src="img/logo.png" alt="SmartEV Logo" class="navbar-logo">
        </div>
        <div class="navbar-right">
            <a class="nav-link logout-link" href="logout.php">
                <i class="mdi mdi-logout"></i> Terminar Sessão
            </a>
            <?php if (isset($_SESSION['tipo'])): ?>
                <span class="nav-link user-type" style="margin-left: 20px; color: #ffd700;">
                    User: <?php echo htmlspecialchars($_SESSION['tipo']); ?>
                </span>
            <?php endif; ?>
        </div>
    </nav>
    <!-- CABEÇALHO -->
    <header class="project-title">
        <h1>SmartEV Monitor</h1>
    </header>
    <!-- CONTEÚDO PRINCIPAL -->
    <div class="container mb-5">
        <!-- SENSORES -->
        <h2 class="section-title mt-5">Sensores</h2>
        <hr class="section-divider">
        <div class="row">
            <!-- Cartão do sensor: POTÊNCIA -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">POTÊNCIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Lê o valor atual do sensor POTÊNCIA a partir de ficheiro
                            $velocidade = @file_get_contents("api/files/potencia/valor.txt");
                            echo $velocidade ? htmlspecialchars(trim($velocidade)) . ' km/h' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-speedometer"></i>
                    </div>
                    <p class="sensor-description">Velocidade atual do veículo</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=potencia" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cartão do sensor: LUMINOSIDADE -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">LUMINOSIDADE</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Lê o valor atual do sensor LUMINOSIDADE a partir de ficheiro
                            $luminosidade = @file_get_contents("api/files/luminosidade/valor.txt");
                            echo $luminosidade ? htmlspecialchars(trim($luminosidade)) . ' °LUX' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-weather-sunny"></i>
                    </div>
                    <p class="sensor-description">Luminosidade exterior detetada</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=luminosidade" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cartão do sensor: CARGA DA BATERIA -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">CARGA DA BATERIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Lê o valor atual do sensor CARGA DA BATERIA a partir de ficheiro
                            $bateria = @file_get_contents("api/files/bateria/valor.txt");
                            echo $bateria ? htmlspecialchars(trim($bateria)) . '%' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-battery-80"></i>
                    </div>
                    <p class="sensor-description">Carga atual da bateria</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=bateria" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ATUADORES -->
        <h2 class="section-title mt-5">Atuadores</h2>
        <hr class="section-divider">
        <div class="row">
            <!-- Cartão do atuador: SENSOR DE DISTÂNCIA -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">SENSOR DE DISTÂNCIA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Lê o valor atual do sensor DISTÂNCIA a partir de ficheiro
                            $distancia = @file_get_contents("api/files/distancia/valor.txt");
                            echo $distancia ? htmlspecialchars(trim($distancia)) . ' CM' : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-ruler"></i>
                    </div>
                    <p class="sensor-description">Distância atual do veículo da frente</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=distancia" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cartão do atuador: SEGURANÇA -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">SEGURANÇA</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Lê o valor atual do sensor SEGURANÇA a partir de ficheiro
                            $seguranca = @file_get_contents("api/files/seguranca/valor.txt");
                            echo $seguranca ? htmlspecialchars(trim($seguranca)) : 'N/A';
                            ?>
                        </span>
                        <i class="mdi mdi-lock"></i>
                    </div>
                    <p class="sensor-description">Estado atual da porta</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=seguranca" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cartão do atuador: LUZES -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">LUZES</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Determina o estado das luzes com base no valor do sensor de LUMINOSIDADE
                            $luminosidade = @file_get_contents("api/files/luminosidade/valor.txt");
                            $estado_luz = 'N/A';
                            if ($luminosidade !== false) {
                                $lux = intval(trim($luminosidade));
                                $estado_luz = $lux < 500 ? 'Ligadas' : 'Desligadas';
                            }
                            echo $estado_luz;
                            ?>
                        </span>
                        <i class="mdi mdi-car-parking-lights"></i>
                    </div>
                    <p class="sensor-description">Estado atual da luminosidade</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=luzes" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Cartão do atuador: CARREGAR -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">CARREGAR</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <i class="mdi mdi-battery-charging-100" style="font-size: 48px;"></i>
                        </span>
                    </div>
                    <p class="sensor-description">Simula o carregamento da bateria</p>
                    <!-- Envia valor atualizado para o sensor CARGA DA BATERIA através da API -->
                    <button id="carregar-btn" class="btn btn-warning">Carregar</button>
                    <div id="carregar-alerta" class="alerta-sucesso" style="display: none;">
                        Bateria carregada com sucesso!
                    </div>
                </div>
            </div>
            <!-- Cartão do atuador: DESCARREGAR -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">DESCARREGAR</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <i class="mdi mdi-battery-alert" style="font-size: 48px;"></i>
                        </span>
                    </div>
                    <p class="sensor-description">Simula a descarga da bateria</p>
                    <!-- Envia valor atualizado para o sensor CARGA DA BATERIA através da API -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-warning flex-fill mx-1" onclick="enviarDescarga(50)">50%</button>
                        <button class="btn btn-outline-warning flex-fill mx-1" onclick="enviarDescarga(20)">20%</button>
                        <button class="btn btn-outline-warning flex-fill mx-1" onclick="enviarDescarga(0)">OFF</button>
                    </div>
                    <div id="descarga-alerta" class="alerta-sucesso" style="display: none; margin-top: 10px;">
                        Valor enviado com sucesso!
                    </div>
                </div>
            </div>
            <!-- Cartão do sensor: AI VISION -->
            <div class="col-md-4">
                <div class="sensor-card">
                    <h4 class="card-title">AI VISION</h4>
                    <div class="sensor-status-block">
                        <span class="sensor-value">
                            <?php
                            // Mostra a imagem captada pela AI Vision
                            echo "<img src='api/images/webcam.jpg?id=" . time() . "' style='width:100%'>";
                            ?>
                        </span>
                        <i class="mdi mdi-cam"></i>
                    </div>
                    <p class="sensor-description">Imagem</p>
                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] !== 'user'): ?>
                        <a href="historico.php?sensor=camera" class="btn-warning">Histórico</a>
                    <?php endif; ?>
                    <?php
                    // Mapeamento dos valores do sensor AI VISION para a legenda apresentada:
                    // 0 = Nada, 1 = Pessoa, 2 = Sinal Stop
                    $camera = @file_get_contents("api/files/camera/valor.txt");
                    if ($camera === '0') {
                        $camera = 'Nada';
                    } elseif ($camera === '1') {
                        $camera = 'Pessoa';
                    } elseif ($camera === '2') {
                        $camera = 'Sinal Stop';
                    } else {
                        $camera = 'Nada';
                    }
                    echo "<p class='sensor-description'>Detetado: " . htmlspecialchars($camera) . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="dashboard-footer">
        <p class="mb-1">Projeto desenvolvido no âmbito da unidade curricular de Tecnologias de Internet</p>
        <p class="mb-1">Desenvolvido por Pedro Trindade e Gonçalo Neto</p>
        <p class="mb-0">
            <i class="mdi mdi-github"></i>
            <a href="https://github.com/frealaf/SmartEV_Monitor" target="_blank" class="text-warning text-decoration-none"> Ver no GitHub</a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função auxiliar para mostrar e ocultar alertas
        function mostrarAlerta(id) {
            const alerta = document.getElementById(id);
            alerta.style.display = 'block';
            setTimeout(() => {
                alerta.style.display = 'none';
            }, 3000);
        }

        // Evento para o botão CARREGAR
        document.getElementById('carregar-btn').addEventListener('click', function () {
            const data = new URLSearchParams();
            data.append('sensor', 'bateria');
            data.append('valor', '100');
            data.append('hora', new Date().toISOString().slice(0, 19).replace('T', ' '));

            fetch('api/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data
            })
                .then(response => {
                    mostrarAlerta('carregar-alerta');
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao enviar os dados.');
                });
        });

        // Função para enviar valor de descarga
        function enviarDescarga(valor) {
            const data = new URLSearchParams();
            data.append('sensor', 'bateria');
            data.append('valor', valor);
            data.append('hora', new Date().toISOString().slice(0, 19).replace('T', ' '));

            fetch('api/api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data
            })
                .then(response => {
                    if (response.ok) {
                        mostrarAlerta('descarga-alerta');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }
</script>

<script>
// Atualização periódica dos valores dos sensores
const UPDATE_INTERVAL_MS = 5000; // pode alterar para 3000, 10000, etc.
setInterval(() => {
    fetch('api/valores_sensores.php')
        .then(res => res.json())
        .then(data => {
            // POTÊNCIA
            const potenciaEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('POTÊNCIA'))?.nextElementSibling?.querySelector('.sensor-value');
            if (potenciaEl) potenciaEl.innerText = data.potencia + ' km/h';

            // LUMINOSIDADE
            const luminosidadeEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('LUMINOSIDADE'))?.nextElementSibling?.querySelector('.sensor-value');
            if (luminosidadeEl) luminosidadeEl.innerText = data.luminosidade + ' °LUX';

            // CARGA DA BATERIA
            const bateriaEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('CARGA DA BATERIA'))?.nextElementSibling?.querySelector('.sensor-value');
            if (bateriaEl) bateriaEl.innerText = data.bateria + '%';

            // SENSOR DE DISTÂNCIA
            const distanciaEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('SENSOR DE DISTÂNCIA'))?.nextElementSibling?.querySelector('.sensor-value');
            if (distanciaEl) distanciaEl.innerText = data.distancia + ' CM';

            // SEGURANÇA
            const segurancaEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('SEGURANÇA'))?.nextElementSibling?.querySelector('.sensor-value');
            if (segurancaEl) segurancaEl.innerText = data.seguranca;

            // LUZES (com base na luminosidade)
            const luzesEl = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('LUZES'))?.nextElementSibling?.querySelector('.sensor-value');
            if (luzesEl) {
                const lux = parseInt(data.luminosidade);
                const estadoLuz = lux < 500 ? 'Ligadas' : 'Desligadas';
                luzesEl.innerText = estadoLuz;
            }

            // AI VISION
            const camImg = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('AI VISION'))?.nextElementSibling?.querySelector('img');
            if (camImg) camImg.src = 'api/images/webcam.jpg?id=' + new Date().getTime();

            const cameraCard = Array.from(document.querySelectorAll('.card-title')).find(el => el.textContent.includes('AI VISION'))?.parentElement;
            if (cameraCard) {
                const descs = cameraCard.querySelectorAll('.sensor-description');
                if (descs.length > 1) {
                    let legenda = 'Nada';
                    if (data.camera === '1') legenda = 'Pessoa';
                    else if (data.camera === '2') legenda = 'Sinal Stop';
                    descs[1].innerText = "Detetado: " + legenda;
                }
            }
        });
}, UPDATE_INTERVAL_MS);
</script>
</body>

</html>