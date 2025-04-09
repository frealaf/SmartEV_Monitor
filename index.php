<?php
ob_start();
session_start();

// Passwords:
// goncalo => 5678
// pedro => 1234

$utilizadores = [
    'goncalo' => '$2y$10$n4DXdJMpCA2M3XInGYt2GulmpaAjODiUQa8z4NyUKL4l.kPdEMZtq', // 5678
    'pedro' => '$2y$10$FvKxU0w7ZVFemke4b./qo.6WduzgV/Ot/c84gEgxgs/Og/WBqU6gy'  // 1234
];

$erro_login= false;

// Verifica se o utilizador já está autenticado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";
    // Verifica se o utilizador existe e se a palavra-passe está correta
    if (isset($utilizadores[$username]) && password_verify($password, $utilizadores[$username])) {
        // credenciais validas
        $_SESSION['username'] = $username; // Armazena o nome de utilizador na sessão
        header('Location: dashboard.php'); 
        exit();
    } else {
        // credenciais invalidas
        $erro_login = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/login.css?id=4">
    <title>Login - SmartEV Monitor</title>
</head>
<body class="login-body">
    <div class="login-wrapper">
        <div class="logo-container">
            <img src="img/logo1.png" alt="SmartEV Logo" class="logo">
        </div>
        <div class="login-container">
            <div class="login-box">
                <h1 class="login-title">SmartEV Monitor</h1>
                <?php if ($erro_login): ?>
                    <div class="alert alert-danger" role="alert">
                        Utilizador ou palavra-passe incorretos.
                    </div>
                <?php endif; ?>
                <form method="POST" action="index.php" autocomplete="off" class="login-form">
                    <div class="form-group">
                        <label for="username" class="form-label">Utilizador</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Palavra-passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Entrar</button> <!-- alterar botão de login -->
                </form>
            </div> <!-- fecha login-box -->
        </div> <!-- fecha login-container -->
    </div> <!-- fecha login-wrapper -->
    <?php ob_end_flush(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
