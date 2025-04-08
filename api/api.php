<?php

header('Content-Type: text/html; charset=utf-8');

// echo "Método HTTP usado: " . $_SERVER['REQUEST_METHOD'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Método HTTP usado: POST";
    print_r ( $_POST );
    if (isset($_POST['sensor']) && isset($_POST['valor']) && isset($_POST['hora'])) {
        $sensor = $_POST['sensor'];
        file_put_contents("files/$sensor/nome.txt", $sensor);
        file_put_contents("files/$sensor/valor.txt", $_POST['valor']);
        file_put_contents("files/$sensor/hora.txt", date('Y-m-d H:i:s'));
        file_put_contents("files/$sensor/log.txt", $_POST['valor'].";".date('Y-m-d H:i:s')."\n", FILE_APPEND);

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
