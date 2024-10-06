<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <style>
        /* Estilo básico para o menu */
        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Estilo para a área de boas-vindas */
        .welcome {
            margin-top: 20px;
            text-align: center;
        }

        .welcome img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .welcome h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <!-- Menu de navegação -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="cursos.php">Cursos</a>
        <a href="mais.php">Mais</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="utilits/logout.php">Logout</a>
        <?php else: ?>
            <a href="login.html">Login</a>
        <?php endif; ?>
    </div>

    <!-- Seção de boas-vindas -->
    <div class="welcome">
        <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Bem-vindo, <?php echo $_SESSION['username']; ?>!</h2>
            <img src="<?php echo isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'https://th.bing.com/th/id/R.1871862d87bb8037d953317fb4497189?rik=MBf1NyuchSQUtQ&riu=http%3a%2f%2fwww.pngall.com%2fwp-content%2fuploads%2f5%2fProfile.png&ehk=Ouu2uMvvMPnkP1bdIY2BTAzbwhRoG9p03NUzbwGLhlg%3d&risl=&pid=ImgRaw&r=0'; ?>" alt="Imagem de perfil">
            <p>Aqui estão os detalhes do seu perfil!</p>
        <?php else: ?>
            <h2>Bem-vindo ao nosso site!</h2>
            <p>Faça login para acessar os cursos e mais!</p>
        <?php endif; ?>
    </div>

</body>
</html>
