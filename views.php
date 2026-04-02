<?php

include "db.php";

/* RESUMO */

$summary = [];

$sql1 = "SELECT * FROM view_projects_summary";

$result1 = $conn->query($sql1);

while ($row = $result1->fetch_assoc()) {
    $summary[] = $row;
}


/* CATEGORIAS */

$categories = [];

$catResult = $conn->query("SELECT * FROM categories");

while ($row = $catResult->fetch_assoc()) {
    $categories[] = $row;
}


/* FILTRO */

$filtered = [];

$selectedCategory = "";

if (isset($_POST["category"])) {

    $selectedCategory = $_POST["category"];

    $sql2 = "SELECT * FROM view_projects_by_category
             WHERE category_id = '$selectedCategory'";
} else {

    $sql2 = "SELECT * FROM view_projects_by_category";
}

$result2 = $conn->query($sql2);

while ($row = $result2->fetch_assoc()) {
    $filtered[] = $row;
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <title>Views</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">

    <style>
    :root {
        --font1: #56070c;
        --font2: #280903;
        --color1: #873632;
        --color2: #a9534d;
        --color3: #075651;
    }

    body {
        font-family: Poppins;
        background: #f5f5f5;
        padding: 20px;
    }

    h2 {
        color: var(--font1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        background: white;
    }

    th {
        background: var(--color1);
        color: white;
        padding: 10px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    form {
        margin-bottom: 20px;
    }

    button {
        background: var(--color3);
        color: white;
        border: none;
        padding: 8px 12px;
    }
    </style>

</head>

<body>


    <h2>Resumo dos Projetos</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Data</th>
        </tr>

        <?php foreach ($summary as $p) { ?>

        <tr>

            <td><?= $p["id"] ?></td>
            <td><?= $p["title"] ?></td>
            <td><?= $p["description"] ?></td>
            <td><?= $p["category_name"] ?></td>
            <td><?= $p["creation_date"] ?></td>

        </tr>

        <?php } ?>

    </table>



    <h2>Filtrar por Categoria</h2>

    <form method="POST">

        <select name="category">

            <option value="">Todas</option>

            <?php foreach ($categories as $c) { ?>

            <option value="<?= $c["id"] ?>">

                <?= $c["name"] ?>

            </option>

            <?php } ?>

        </select>

        <button>Filtrar</button>

    </form>



    <table>

        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
        </tr>

        <?php foreach ($filtered as $p) { ?>

        <tr>

            <td><?= $p["id"] ?></td>
            <td><?= $p["title"] ?></td>
            <td><?= $p["description"] ?></td>
            <td><?= $p["category_name"] ?></td>

        </tr>

        <?php } ?>

    </table>


</body>

</html>