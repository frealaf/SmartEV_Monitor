<?php
// Este script gera uma galeria das últimas 10 imagens guardadas no histórico (images/historico/)
// Acrescenta um botão para voltar ao dashboard principal

$directory = __DIR__ . '/api/images/historico/';
$images = [];

// Se a pasta existir, lê as imagens
if (file_exists($directory)) {
    $images = array_diff(scandir($directory, SCANDIR_SORT_DESCENDING), array('..', '.'));

    // Mantém apenas as 10 imagens mais recentes
    $images = array_slice($images, 0, 10);
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Imagens Recebidas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        h2.text-warning {
            color: #ffc107;
            font-family: 'Segoe UI', sans-serif;
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .back-button:hover {
            background-color: #218838;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .image-card {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: transform 0.2s;
            position: relative;
        }

        .image-card:hover {
            transform: scale(1.05);
        }

        .image-card img {
            width: 100%;
            height: auto;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .label {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .timestamp {
            padding: 8px;
            font-size: 14px;
            color: #555;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>


    <h2 class="text-warning mb-4 text-center">Histórico de Imagens Recebidas</h2>

    <div class='gallery'>

    <?php
    // Cria a galeria
    foreach ($images as $image) {
        $imageUrl = 'api/images/historico/' . $image;

        // Extrai a label e o timestamp do nome do ficheiro
        // Formato esperado: label_YYYY-MM-DD_HH-MM-SS.extensao
        $nameParts = explode('_', $image, 2);
        $label = $nameParts[0];

        $timestampText = 'Sem timestamp';
        if (isset($nameParts[1])) {
            $timestampPart = pathinfo($nameParts[1], PATHINFO_FILENAME);
            $timestampText = str_replace('_', ' ', $timestampPart);
        }

        // Cria o cartão para cada imagem
        echo "
            <div class='image-card'>
                <img src='$imageUrl' alt='$label'>
                <div class='badge'>$label</div>
                <div class='timestamp'>Detectado em: $timestampText</div>
            </div>
        ";
    }
    ?>

    </div>
</body>
</html>