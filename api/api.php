<?php
// Define o tipo de conteúdo da resposta como texto HTML com codificação UTF-8
header('Content-Type: text/html; charset=utf-8');

// Mostra o método HTTP usado na requisição (GET, POST, etc.)
// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST";
    print_r($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "GET";
} else {
    echo "Unsupported request method";
}

?>
