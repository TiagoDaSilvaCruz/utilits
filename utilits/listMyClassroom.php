<?php
session_start();

require "config.php";

if (!isset($_SESSION['user_id'])) {
    echo "Usuário não está logado.";
    exit();
}

// Selecionar dados de myClassroom baseado no id_user
$sql = "SELECT * FROM myClassroom WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se há resultados
if ($result->num_rows === 0) {
    echo "Nenhuma sala encontrada para este usuário.";
    exit();
}

// Iterar sobre cada resultado da consulta à tabela myClassroom
while ($get = $result->fetch_assoc()) {
    // Selecionar dados da tabela classroom baseado no id obtido de myClassroom
    $sqlClassroom = "SELECT * FROM classroom WHERE id = ?";
    $stmtClassroom = $conn->prepare($sqlClassroom);
    $stmtClassroom->bind_param("i", $get['id']);
    $stmtClassroom->execute();
    $resultClassroom = $stmtClassroom->get_result();

    // Iterar sobre os resultados da consulta à tabela classroom
    while ($row = $resultClassroom->fetch_assoc()) {
        echo "<p>{$row['name']}</p>";  // Substitua 'name' pelo nome real da coluna que você quer exibir
    }
}
?>
