<?php
    require "config.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $name = $_POST["name"];

        $sql = "SELECT * FROM classroom WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows >= 0) {
            function gerarChaveSegura($length = 16) {
                return bin2hex(openssl_random_pseudo_bytes($length / 2));
            }
    
            $cod = gerarChaveSegura(16);
    
            $sql = "INSERT INTO classroom (name, cod) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $name, $cod);

            if ($stmt->execute()) {
                echo "sala criada com sucesso!";
            } else {
                echo "Erro: " . $stmt->error;
            }
        }


    } else {
        echo "Acesso negado";
    }
?>