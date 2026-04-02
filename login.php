<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        :root {
            --font1: #56070c;
            --font2: #280903;
            --color1: #873632;
            --color2: #a9534d;
            --color3: #075651;
        }

        /* RESET */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* BODY */

        body {
            background: linear-gradient(135deg, var(--color1), var(--color2));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--font2);
        }

        /* CARD */

        .auth-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 360px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        /* TITLE */

        .auth-container h2 {
            color: var(--font1);
            margin-bottom: 25px;
            font-size: 24px;
        }

        /* FORM */

        .auth-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* INPUTS */

        .auth-container input,
        .auth-container select {
            padding: 12px;
            border: 1px solid var(--color2);
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .auth-container input:focus,
        .auth-container select:focus {
            outline: none;
            border-color: var(--color1);
        }

        /* BUTTON */

        .auth-container button {
            background: var(--color3);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .auth-container button:hover {
            background: var(--color1);
        }

        /* LINK ENTRE LOGIN E REGISTO */

        .switch-form {
            margin-top: 15px;
            font-size: 14px;
        }

        .switch-form a {
            color: var(--color1);
            text-decoration: none;
            font-weight: 500;
        }

        .switch-form a:hover {
            color: var(--color3);
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="auth-container">

        <h2>Login</h2>

        <form action="login_process.php" method="POST">

            <input type="text" name="username" placeholder="Nome de utilizador" required>

            <input type="password" name="password" placeholder="Senha" required>

            <button type="submit">Entrar</button>

        </form>

        <p class="switch-form">
            Não tem conta? <a href="register.php">Registe-se</a>
        </p>

    </div>

</body>

</html>