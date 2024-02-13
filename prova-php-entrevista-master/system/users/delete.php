<?php
require '../../includes/Connection.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $connection = new Connection();

    $query = "DELETE FROM users WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);

    try {
       
        $statement->execute();

        header("Location: list.php");
        exit();
    } catch(PDOException $e) {
      
        echo "Erro ao deletar usuário: " . $e->getMessage();
        exit();
    }
} else {
   
    echo "ID do usuário não fornecido.";
    exit();
}
?>