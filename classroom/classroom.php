<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Sala de Aula</title>
</head>
<body>
    <h2>Criar Sala de Aula</h2>

    <form action="../utilits/process_create_classroom.php" method="POST">
        <label for="name">Nome da Sala:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <button type="submit">Criar Sala</button>
    </form>

    <br><br><br>

    <h2>Entra na Sala de Aula</h2>

    <form action="../utilits/process_login_classroom.php" method="POST">
        <label for="name">Codigo da Sala:</label><br>
        <input type="text" id="cod" name="cod" required><br><br>
        <button type="submit">Entrar</button>
    </form>

    <br><br>

    <h2>Minhas Salas de Aula</h2>

    <?php
        require "../utilits/listMyClassroom.php";
    ?>

</body>
</html>
