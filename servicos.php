<?php
include "db.php";

$projects = [];

$sql = "SELECT projects.*, categories.name AS category_name 
        FROM projects
        LEFT JOIN categories ON projects.category_id = categories.id
        ORDER BY creation_date DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $projects[] = $row;
}
?>
<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Serviços</title>
    <link rel="stylesheet" href="css/style.css" />

    <style>
    .projects-container {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        padding: 30px;
        justify-content: center;
    }

    .project-card {
        width: 300px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .project-card img {
        width: 100%;
        height: 250px;
        object-fit: contain;
        background: #f0f0f0;
    }


    .project-info {
        padding: 15px;
    }

    .project-info h3 {
        margin-bottom: 10px;
        color: #56070c;
    }

    .project-info p {
        font-size: 14px;
        color: #333;
        margin-bottom: 10px;
    }

    .project-info small {
        display: block;
        color: #666;
        margin-bottom: 5px;
    }

    /* --- SEÇÃO SOBRE O PROJETO --- */

    .project-description {
        padding: 30px;
        max-width: 900px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .project-description h2 {
        color: #56070c;
        margin-bottom: 15px;
        font-size: 26px;
    }

    .project-description h3 {
        color: #56070c;
        margin-top: 25px;
        margin-bottom: 8px;
        font-size: 20px;
    }

    .project-description p {
        font-size: 16px;
        line-height: 1.7;
        color: #333;
        margin-bottom: 10px;
    }

    /* Ícones bonitos */
    .project-description h3::before {
        content: "• ";
        color: #a9534d;
        font-weight: bold;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .project-description {
            padding: 20px;
            margin: 20px;
        }

        .project-description h2 {
            font-size: 22px;
        }

        .project-description h3 {
            font-size: 18px;
        }

        .project-description p {
            font-size: 15px;
        }
    }
    </style>
</head>

<body>

    <header>
        <h1>Serviços</h1>
        <nav class="menu">
            <ul>
                <li><a href="portifolio.html">Home</a></li>
                <li><a href="sobre.html">Sobre</a></li>


                <li class="dropdown">
                    <a href="">Projetos</a>

                    <div class="dropdown-menu">
                        <a href="projetos/projeto-front-end.html">Front-end</a>
                        <a href="projetos/projeto-back-end.html">Back-end</a>
                        <a href="projetos/projeto-uxui.html">UxUi</a>
                    </div>
                </li>

                <li><a href="contactos.html">Contactos</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2 style="margin-left: 15px">Aqui estão alguns dos nossos serviços</h2>
    </section>

    <section class="project-description">
        <h2>Sobre este Projeto</h2>

        <p>
            Este projeto consiste no desenvolvimento de um website profissional para uma banda musical,
            criado com o objetivo de facilitar a comunicação com os fãs, divulgar eventos e oferecer
            ferramentas práticas para contratação, venda de ingressos e de itens da banda. O site foi projetado para ser
            intuitivo, moderno e totalmente gerenciável através de um painel administrativo.
        </p>

        <h3>Apresentação da Banda</h3>
        <p>
            O site apresenta a história da banda, seus integrantes, estilo musical e trajetória artística,
            permitindo que os visitantes conheçam melhor o grupo e se conectem com sua identidade.
        </p>

        <h3>Agenda de Shows</h3>
        <p>
            Uma agenda dinâmica exibe os próximos concertos, incluindo datas, horários e locais.
            Todas as informações podem ser atualizadas facilmente pelo administrador, garantindo que
            os fãs estejam sempre informados sobre novos eventos.
        </p>

        <h3>Venda de Ingressos</h3>
        <p>
            O site oferece uma interface simples e prática para compra de ingressos. Cada evento possui
            detalhes completos e links diretos para aquisição, tornando o processo rápido e acessível.
        </p>

        <h3>Localização dos Eventos</h3>
        <p>
            Para facilitar o acesso aos shows, o site inclui mapas interativos com a localização dos eventos,
            permitindo que os visitantes encontrem facilmente o local do concerto.
        </p>

        <h3>Formulário de Contratação</h3>
        <p>
            Produtores, organizadores e empresas podem solicitar orçamentos ou contratar a banda através
            de um formulário profissional. As informações são enviadas diretamente ao administrador,
            garantindo um processo rápido e eficiente.
        </p>

        <h3>Galeria e Projetos</h3>
        <p>
            O administrador pode adicionar novos projetos, fotos e conteúdos através do painel interno
            (admin.php). As atualizações aparecem automaticamente na página pública, sem necessidade
            de editar código manualmente.
        </p>
    </section>

    <section class="projects-container">

        <?php foreach ($projects as $p): ?>
        <div class="project-card">

            <?php if (!empty($p['image'])): ?>
            <img src="<?php echo $p['image']; ?>" alt="Imagem do projeto">
            <?php else: ?>
            <img src="Photos/default.jpg" alt="Sem imagem">
            <?php endif; ?>

            <div class="project-info">
                <h3><?php echo $p['title']; ?></h3>
                <p><?php echo $p['description']; ?></p>
                <small><b>Categoria:</b> <?php echo $p['category_name']; ?></small>
                <small><b>Data:</b> <?php echo $p['creation_date']; ?></small>
            </div>
        </div>
        <?php endforeach; ?>

    </section>

</body>

</html>