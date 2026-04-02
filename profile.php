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

<h2>Perfil</h2>

<p>Username: <?php echo $user["username"]; ?></p>
<p>Email: <?php echo $user["email"]; ?></p>
<p>Tipo: <?php echo $user["user_type"]; ?></p>

<img src="<?php echo $user["profile_pic"]; ?>" width="120">

<br><br>

<a href="logout.php">Logout</a>