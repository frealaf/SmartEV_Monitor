<?php
session_start(); // permite guardar dados na sessão

// Redireciona se já estiver autenticado
if (isset($_SESSION['username'])) {
    header('Location: dashboard/dashboard.php');
    exit();
}

$error= '';

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $file = fopen("users.txt", "r");

    if ($file) {
        while (($line = fgets($file)) !== false) {
            $credenciais = explode(":", trim($line));
            if (count($credenciais) == 2) {
                $user = $credenciais[0]; // username
                $pass = $credenciais[1]; // password
                if ($username == $user && $password == $pass) {
                    $_SESSION['username'] = $username;
                    
                    fclose($file);
                    header('Location: dashboard/dashboard.php');
                    exit();
                }
            }
        }
        fclose($file);
    }
    $error = "Nome de utilizador ou palavra-passe inválidos.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - SynDrive</title>
</head>
<body>
    <h2>Login SynDrive</h2>

    <!-- Mostra mensagem de erro se existir -->
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Formulário de login -->
    <form method="post">
        <label for="username">Utilizador:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Palavra-passe:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>


 