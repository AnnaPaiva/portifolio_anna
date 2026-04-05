<?php


session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location:portifolio.html");
    exit;
}

$id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    :root {
        --font1: #56070c;
        --font2: #280903;
        --color1: #873632;
        --color2: #a9534d;
        --color3: #075651;
    }

    body {
        background-color: var(--font1);
        color: #f9f2f2;
        font-family: "Amatic SC", sans-serif;
    }

    /* CONTAINER PRINCIPAL */
    .profile-container {
        max-width: 900px;
        margin: 60px auto;
        background-color: var(--font2);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }

    /* TÍTULO */
    .profile-container h2 {
        text-align: center;
        font-size: 42px;
        margin-bottom: 25px;
        border-bottom: 2px solid var(--color2);
        padding-bottom: 10px;
    }

    /* GRID DO PERFIL */
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        align-items: center;
    }

    /* FOTO */
    .profile-img {
        width: 100%;
        max-width: 200px;
        border-radius: 50%;
        border: 3px solid var(--color2);
        object-fit: cover;
    }

    /* DADOS */
    .profile-info p {
        font-size: 22px;
        margin-bottom: 10px;
        border-bottom: 1px solid var(--font2);
        padding-bottom: 5px;
    }

    .profile-info strong {
        color: var(--color2);
    }

    /* BOTÕES */
    .profile-actions {
        margin-top: 25px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .profile-actions a {
        padding: 10px 20px;
        background-color: var(--font2);
        border: 1px solid var(--color2);
        color: #f9f2f2;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s;
        font-size: 18px;
    }

    .profile-actions a:hover {
        background-color: var(--color2);
        color: #edeaea;
    }

    /* RESPONSIVO */
    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .profile-img {
            margin: 0 auto;
        }
    }
    </style>
</head>

<body>
    <h2>Perfil</h2>

    <div class="profile-info">
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Tipo:</strong> <?= htmlspecialchars($user['user_type']) ?></p>
        <?php
        $foto = !empty($user['profile_pic']) ? $user['profile_pic'] : 'default.png';
        ?>

        <img src="uploads/<?= htmlspecialchars($foto) ?>" alt="Foto de perfil" class="profile-img"
            onerror="this.src='https://placehold.co/200x200?text=Sem+foto'">
    </div>

    <br><br>

    <div class=" profile-actions">
        <a href="loja.php">Ir para Loja</a>
        <a href="logout.php">Sair</a>
    </div>

</body>

</html>