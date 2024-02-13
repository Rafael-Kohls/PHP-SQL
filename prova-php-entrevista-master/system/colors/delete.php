<?php
require '../../includes/Connection.php';


if(isset($_GET['id'])) {
    $id = $_GET['id'];


    $connection = new Connection();


    $query = "DELETE FROM colors WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);

    try {
        $statement->execute();

        header("Location: list.php");
        exit();
    } catch(PDOException $e) {

        echo "Erro ao deletar cor: " . $e->getMessage();
        exit();
    }
} else {

    echo "ID da cor não fornecido.";
    exit();
}
?>