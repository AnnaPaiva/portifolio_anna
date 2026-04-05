<?php
$host = 'localhost';
$db   = 'portifolio';
$user = 'root'; // Alterar conforme necessário
$pass = '';     // Alterar conforme necessário

// Conexão com MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define charset para UTF-8
$conn->set_charset("utf8");
