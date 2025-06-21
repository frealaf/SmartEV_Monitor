<?php

header('Content-Type: text/html; charset=utf-8');

// echo "Método HTTP usado: " . $_SERVER['REQUEST_METHOD'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "Método HTTP usado: POST";
    // print_r($_POST);
    if (isset($_POST['sensor']) && isset($_POST['valor'])) {
        // Extrai os dados enviados e guarda-os em ficheiros individuais
        $sensor = $_POST['sensor'];
        $valor = $_POST['valor'];
        $hora = $_POST['hora'] ?? date('Y-m-d H:i:s');

        // Guarda o nome do sensor
        file_put_contents("files/$sensor/nome.txt", $sensor);
        // o valor atual do sensor
        file_put_contents("files/$sensor/valor.txt", $valor);
        // a hora de atualização do sensor
        file_put_contents("files/$sensor/hora.txt", $hora);
        // adiciona o valor e hora ao log
        $valor = $_POST['valor'];
        file_put_contents("files/$sensor/log.txt", date("Y-m-d H:i:s") . " ; " . $valor . "\n", FILE_APPEND);
        http_response_code(200);
        exit();
    } else {
        http_response_code(400);
        echo "Erro: Parâmetros inválidos.";
    } // realizar o else de erro se os parametros não entrarem todos
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["sensor"])) {
        $sensor = $_GET["sensor"];
        $tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "valor";  // valor ou hora
        $ficheiro = "files/$sensor/{$tipo}.txt";

        if (file_exists($ficheiro)) {
            header('Content-Type: text/plain');
            echo trim(file_get_contents($ficheiro));
        } else {
            http_response_code(404);
            echo "Ficheiro não encontrado.";
        }
    } else {
        http_response_code(400);
        echo "Faltam parâmetros no GET.";
    }
}
?>