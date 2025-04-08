<?php
ob_start(); // Garante que não há saída antes do header
session_start(); // Inicia a sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Termina a sessão
// Redireciona para a página de login
header('Location: login.php');
exit();
?>
