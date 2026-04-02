<?php

include "db.php";

$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];
$confirm = $_POST["confirm_password"];
$type = $_POST["user_type"];

$response = [];

/* VALIDAÇÕES */

if (strlen($username) < 3) {
    $response["error"] = "Username precisa ter pelo menos 3 caracteres";
    echo json_encode($response);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response["error"] = "Email inválido";
    echo json_encode($response);
    exit;
}

if (strlen($password) < 6) {
    $response["error"] = "Senha precisa ter 6 caracteres";
    echo json_encode($response);
    exit;
}

if ($password != $confirm) {
    $response["error"] = "Senhas não coincidem";
    echo json_encode($response);
    exit;
}

/* VERIFICAR USERNAME E EMAIL */

$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response["error"] = "Username ou email já existe";
    echo json_encode($response);
    exit;
}

/* FOTO DE PERFIL */

$uploadDir = "uploads/";
$imageName = basename($_FILES["profile_pic"]["name"]);
$imagePath = $uploadDir . $imageName;

move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $imagePath);

/* HASH DA SENHA */

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

/* INSERT */

$sql = "INSERT INTO users(username,email,password_hash,user_type,profile_pic)
VALUES('$username','$email','$passwordHash','$type','$imagePath')";

$conn->query($sql);

$response["success"] = "Registo realizado";

echo json_encode($response);
