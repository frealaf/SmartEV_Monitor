<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerar Hash</title>
</head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Gerar password hash</h2>
    <form method="post">
        <label for="password">Palavra-passe:</label><br>
        <input type="text" name="password" id="password" required><br><br>
        <button type="submit">Gerar hash</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $password = $_POST["password"];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        echo "<h4>Hash gerado:</h4>";
        echo "<code>$hash</code>";
    }
    ?>
</body>
</html>