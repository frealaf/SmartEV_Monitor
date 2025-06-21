<?php
header('Content-Type: application/json');

function lerValor($ficheiro) {
    $valor = @file_get_contents($ficheiro);
    return $valor ? trim($valor) : 'N/A';
}

echo json_encode([
    'potencia' => lerValor('files/potencia/valor.txt'),
    'luminosidade' => lerValor('files/luminosidade/valor.txt'),
    'bateria' => lerValor('files/bateria/valor.txt'),
    'distancia' => lerValor('files/distancia/valor.txt'),
    'seguranca' => lerValor('files/seguranca/valor.txt'),
    'camera' => lerValor('files/camera/valor.txt')
]);
?>
