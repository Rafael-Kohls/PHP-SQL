<?php
include '../../templates/header.php';
require '../../includes/Connection.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $connection = new Connection();

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);

    try {
        $statement->execute();

        // Obtém os dados do usuário
        $user = $statement->fetch();

        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalhes do Usuário</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Detalhes do Usuário
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" disabled>
                        </div>
                        <a href="list.php" class="btn btn-primary">Voltar</a>
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
?>
