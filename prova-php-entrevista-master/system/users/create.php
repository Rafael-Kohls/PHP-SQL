<?php include '../../templates/header.php'; ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Adicionar Usuário
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../../includes/connection.php';  
    $connection = new Connection();
    
    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);


        try {
            $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
            $statement = $connection->prepare($query);

            $statement->bindParam(':name', $name);
            $statement->bindParam(':email', $email);

            if ($statement->execute()) {
                header("Location: list.php");
                exit;
            } else {
                echo "Erro ao inserir usuário.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

<?php include '../../templates/footer.php'; ?>
