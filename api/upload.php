<?php
// Este script recebe um upload de imagem e guarda:
// - a última imagem em images/webcam.jpg (para o dashboard)
// - todas as imagens com timestamp e label em images/historico/ (para o histórico)

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se o campo 'imagem' foi enviado no POST
    if (isset($_FILES['imagem'])) {

        $file = $_FILES['imagem'];

        // Definições
        $maxFileSize = 1000000; // Limite de tamanho: 1000 kB
        $allowedExtensions = ['jpg', 'jpeg', 'png']; // Extensões permitidas

        // Obtém a extensão do ficheiro enviado
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Valida extensão do ficheiro
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Erro: Apenas são permitidos ficheiros .jpg e .png.";
            exit;
        }

        // Valida tamanho do ficheiro
        if ($file['size'] > $maxFileSize) {
            echo "Erro: O ficheiro excede o tamanho máximo de 1000kB.";
            exit;
        }

        // Obtém o label enviado no POST (ex.: pessoa, cao, etc.)
        $label = isset($_POST['label']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['label']) : 'webcam';

        // Define os caminhos de destino
        $dashboardImagePath = __DIR__ . '/images/webcam.jpg';

        // Garante que a pasta historico existe, se não existir cria
        $destinationFolder = __DIR__ . '/images/historico/';

        // Definição do diretório de histórico circular de 10 imagens
        $historicoDir = __DIR__ . '/images/historico/';
        if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0777, true);
            echo "Nota: Pasta 'historico' criada.<br>";
        }

        // Cria um nome de ficheiro com label e timestamp legível
        $timestamp = date("Y-m-d_H-i-s");
        $newFileName = $label . '_' . $timestamp . '.' . $fileExtension;
        $historicalImagePath = $destinationFolder . $newFileName;

        // Move o ficheiro temporário para webcam.jpg (última imagem)
        if (move_uploaded_file($file['tmp_name'], $dashboardImagePath)) {
            echo "Upload efetuado com sucesso para webcam.jpg.<br>";

            // Copia a imagem também para a pasta de histórico
            if (copy($dashboardImagePath, $historicalImagePath)) {
                echo "Imagem também guardada no histórico como $newFileName.";
            } else {
                // Se falhar a cópia, informa no log
                echo "ERRO: Falha ao copiar a imagem para o histórico.";
            }

            // Histórico fixo de 10 imagens (circular buffer)
            $historicoDir = __DIR__ . '/images/historico/';
            if (!file_exists($historicoDir)) {
                mkdir($historicoDir, 0777, true);
            }

            // Lê índice atual
            $indexPath = $historicoDir . 'index.txt';
            $index = file_exists($indexPath) ? (int)file_get_contents($indexPath) : 0;

            // Nome do ficheiro img0.jpg até img9.jpg
            $fixedName = $historicoDir . 'img' . $index . '.jpg';

            // Copia imagem atual para posição do buffer
            copy($dashboardImagePath, $fixedName);

            // Atualiza índice (0 a 9)
            $index = ($index + 1) % 10;
            file_put_contents($indexPath, $index);

        } else {
            // Se falhar a move, apresenta debug
            echo "ERRO: Falha ao mover o ficheiro para webcam.jpg.";
            echo "<br>Debug: file tmp_name = " . $file['tmp_name'];
            echo "<br>Debug: destino = " . $dashboardImagePath;
            echo "<br>Debug: file error = " . $file['error'];
        }

    } else {
        // Se o campo 'imagem' não foi enviado
        echo "Erro: Nenhum ficheiro com o nome 'imagem' foi enviado.";
    }

} else {
    // Se não for um POST, recusa a requisição
    echo "Erro: Este script apenas aceita pedidos POST.";
    exit;
}
?>