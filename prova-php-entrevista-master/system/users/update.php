<?php
include '../../templates/header.php';
require '../../includes/Connection.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Cria uma nova instância da classe Connection para se conectar ao banco de dados
        $connection = new Connection();

        // Prepara a consulta SQL para atualizar os dados
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':id', $id);

        try {
            // Executa a consulta preparada
            $statement->execute();

            // Redireciona de volta
            header("Location: list.php");
            exit();
        } catch(PDOException $e) {
            
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            exit();
        }
    } else {
      
        $connection = new Connection();

        
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':id', $id);

        try {
          
            $statement->execute();

            $user = $statement->fetch();

          
            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Editar Usuário</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Editar Usuário
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        } catch(PDOException $e) {
           
            echo "Erro ao obter dados do usuário: " . $e->getMessage();
            exit();
        }
    }
} else {
    
    echo "ID do usuário não fornecido.";
    exit();
}
?>
