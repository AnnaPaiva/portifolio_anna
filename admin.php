<?php
include "db.php";

$uploadDir = "uploads/";
$searchResults = [];
$categories = [];

/* CARREGAR CATEGORIAS */
$catResult = $conn->query("SELECT * FROM categories");
while ($row = $catResult->fetch_assoc()) {
    $categories[] = $row;
}

/* ADICIONAR PROJETO */
if (isset($_POST["addProject"])) {

    $title       = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);
    $category    = $_POST["category"];
    $imagePath   = "";

    // Upload de imagem
    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $imagePath = $uploadDir . time() . "_" . $imageName; // evita sobrescrever arquivos
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Inserção segura com prepared statement
    $stmt = $conn->prepare("INSERT INTO projects (title, description, category_id, creation_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ssi", $title, $description, $category);
    $stmt->execute();
    $stmt->close();
}

/* BUSCA */
if (isset($_POST["search"])) {
    $keyword = "%" . $_POST["keyword"] . "%";

    $stmt = $conn->prepare(
        "SELECT projects.*, categories.name AS category_name
         FROM projects
         LEFT JOIN categories ON projects.category_id = categories.id
         WHERE title LIKE ? OR description LIKE ?"
    );
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
    $stmt->close();
} else {
    $result = $conn->query(
        "SELECT projects.*, categories.name AS category_name
         FROM projects
         LEFT JOIN categories ON projects.category_id = categories.id"
    );
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin</title>

    <style>
        :root {
            --font1: #56070c;
            --font2: #280903;
            --color1: #873632;
            --color2: #a9534d;
            --color3: #075651;
        }



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }



        body {
            background: #f5f5f5;
            color: var(--font2);
        }



        header {
            background: var(--color1);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        header h1 {
            font-size: 24px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        nav a:hover {
            color: #ffd9d7;
        }

        /* SECTION */

        section {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        h2 {
            color: var(--font1);
            margin-bottom: 15px;
        }

        /* FORM */

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 30px;
        }

        input,
        textarea,
        select {

            padding: 10px;
            border: 1px solid var(--color2);
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus,
        textarea:focus,
        select:focus {

            outline: none;
            border-color: var(--color1);
        }

        /* BUTTON */

        button {

            background: var(--color3);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        button:hover {
            background: var(--color1);
        }

        /* TABLE */

        table {

            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            overflow: hidden;
        }

        th {

            background: var(--color1);
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {

            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #fafafa;
        }

        /* RESPONSIVE */

        @media(max-width:768px) {

            header {
                flex-direction: column;
                align-items: flex-start;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

        }
    </style>
</head>

<body>

    <h1>Administração</h1>

    <h2>Adicionar Projeto</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Título" required>

        <textarea name="description" placeholder="Descrição"></textarea>

        <select name="category">

            <?php foreach ($categories as $cat) { ?>

                <option value="<?php echo $cat["id"]; ?>">
                    <?php echo $cat["name"]; ?>
                </option>

            <?php } ?>

        </select>

        <input type="file" name="image">

        <button name="addProject">Adicionar</button>

    </form>


    <h2>Buscar</h2>

    <form method="POST">

        <input type="text" name="keyword">

        <button name="search">Buscar</button>

    </form>


    <h2>Projetos</h2>

    <table border="1">

        <tr>

            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Data</th>

        </tr>

        <?php foreach ($searchResults as $p) { ?>

            <tr>

                <td><?php echo $p["id"]; ?></td>

                <td><?php echo $p["title"]; ?></td>

                <td><?php echo $p["description"]; ?></td>

                <td><?php echo $p["category_name"]; ?></td>

                <td><?php echo $p["creation_date"]; ?></td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>