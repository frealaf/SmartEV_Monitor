<?php

header('Content-Type: text/html; charset=utf-8');

// echo "Método HTTP usado: " . $_SERVER['REQUEST_METHOD'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Método HTTP usado: POST";
    print_r ( $_POST );
    if (isset($_POST['sensor']) && isset($_POST['valor']) && isset($_POST['hora'])) {
        // Extrai os dados enviados e guarda-os em ficheiros individuais
        $sensor = $_POST['sensor'];     
        // Guarda o nome do sensor
        file_put_contents("files/$sensor/nome.txt", $sensor);
        // o valor atual do sensor
        file_put_contents("files/$sensor/valor.txt", $_POST['valor']);
        // a hora de atualização do sensor
        file_put_contents("files/$sensor/hora.txt", date('Y-m-d H:i:s'));
        // adiciona o valor e hora ao historico
        file_put_contents($ficheiro, date("Y-m-d H:i:s") . " | " . $valor . "\n", FILE_APPEND);
        http_response_code(200);
        echo "Dados recebidos com sucesso!";
    } else {
        http_response_code(400);
        echo "Erro: Parâmetros inválidos.";
    } // realizar o else de erro se os parametros não entrarem todos
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "Método HTTP usado: " . $_SERVER['REQUEST_METHOD'];
} else {
    echo "Método HTTP usado: Inválido";
}



?>
