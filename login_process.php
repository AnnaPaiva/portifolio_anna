<?php

session_start();
include "db.php";

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user["password_hash"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_type"] = $user["user_type"];

        header("Location: profile.php");
        exit;
    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Utilizador não encontrado";
}
