<?php

require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        
       //send
        $connection = new Connection();
        $stmt = $connection->getConnection()->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->bindParam(':name', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error.";
        }
    } else {
        echo "Error, preencha os valores.";
    }
}

?>
