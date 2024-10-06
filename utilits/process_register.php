<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se o e-mail já está cadastrado
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se o e-mail já existir, mostrar uma mensagem de erro
    if ($result->num_rows > 0) {
        echo "Este e-mail já está cadastrado!";
    } else {
        // Criptografar a senha usando password_hash()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Se o campo de imagem estiver vazio, usar uma imagem padrão
        if (empty($profile_image)) {
            $profile_image = 'https://th.bing.com/th/id/R.1871862d87bb8037d953317fb4497189?rik=MBf1NyuchSQUtQ&riu=http%3a%2f%2fwww.pngall.com%2fwp-content%2fuploads%2f5%2fProfile.png&ehk=Ouu2uMvvMPnkP1bdIY2BTAzbwhRoG9p03NUzbwGLhlg%3d&risl=&pid=ImgRaw&r=0'; // URL ou caminho da imagem padrão
        }

        // Inserir os dados no banco, incluindo a URL da imagem
        $sql = "INSERT INTO users (username, email, password, perfil) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $profile_image);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            header('Location: process_login.php');
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>
