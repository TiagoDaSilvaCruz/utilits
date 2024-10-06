<?php
session_start();
require "config.php";

// Verifique se o usuário está logado e se o ID está armazenado na sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod = $_POST["cod"];
    $user_id = $_SESSION['user_id'];  // Obtenha o ID do usuário logado

    // Consulta para obter os dados da sala
    $sql = "SELECT * FROM classroom WHERE cod = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cod);
    $stmt->execute();
    $result = $stmt->get_result();
    $get = $result->fetch_assoc();

    if ($result->num_rows == 1) {
        // Gerar o nome da coluna dinamicamente
        $ind = "p" . ($get['peplo'] + 1);
        $novo_peplo = $get['peplo'] + 1;

        // Atualizar a coluna dinâmica, usando o ID do usuário logado
        $sql = "UPDATE classroom SET `$ind` = ?, peplo = ? WHERE cod = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $novo_peplo, $cod);

        if ($stmt->execute()) {
            echo " Atualização bem-sucedida";
        } else {
            echo " Erro ao atualizar: " . $stmt->error;
        }

        $sql = "INSERT INTO myClassroom (id_classroom, id_user) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $get['id'], $user_id);
        
        if ($stmt->execute()) {
            echo " Adicionado a minha classroom";
        } else {
            echo " Erro ao adicionar a minha classroom";
        }

    } else {
        echo " Sala não encontrada.";
    }

} else {
    echo " Acesso negado";
}
?>
