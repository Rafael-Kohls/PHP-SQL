<?php
include '../../templates/header.php';
require '../../includes/Connection.php';

if(isset($_GET['user'])) {
    $user = $_GET['user'];

    $connection = new Connection();
    $users = $connection->query("SELECT * FROM users
    LEFT JOIN user_colors on user_colors.user_id = users.id
    WHERE id = $user")->fetchAll(PDO::FETCH_OBJ);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['user'];

        // Obtém o ID da cor selecionada
        $color_id = $_POST['color'];

        // Cria uma nova instância da classe Connection para se conectar ao banco de dados
        $connection = new Connection();

        // Verifica se já existe uma entrada para o usuário na tabela user_colors
        $query = "SELECT COUNT(*) as count FROM user_colors WHERE user_id = :user_id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':user_id', $user);
        $statement->execute();
        $count = $statement->fetchColumn();

        if ($count == 0) {
            // Se não houver entrada, insere uma nova entrada
            $query = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        } else {
            // Caso contrário, atualiza a entrada existente
            $query = "UPDATE user_colors SET color_id = :color_id WHERE user_id = :user_id";
        }

        $statement = $connection->prepare($query);
        $statement->bindParam(':color_id', $color_id);
        $statement->bindParam(':user_id', $user);

        try {
            // Executa a consulta preparada
            $statement->execute();

            // Redireciona de volta
            header("Location: ../users/list.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            exit();
        }
    } else {
        $connection = new Connection();

        $query = "SELECT * FROM user_colors WHERE user_id = :user_id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':user_id', $user);

        try {
            $statement->execute();
            $userColor = $statement->fetch(PDO::FETCH_OBJ);

            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Editar Cor do Usuário</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Editar Cor do Usuário
                        </div>
                        <div class="card-body">
                            <form method="post">
                            <?php foreach ($users as $user) : ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="cor" class="form-label">Cor</label>
                                    <select class="form-select" id="color" name="color" required>
                                        <option value="" disabled selected>Selecione uma cor</option>
                                        <?php
                                        $colors = $connection->query("SELECT * FROM colors")->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($colors as $color) : ?>
                                            <option style="color:<?php echo $color->name; ?>" value="<?php echo $color->id; ?>" <?php echo ($userColor && $color->id == $userColor->color_id) ? 'selected' : ''; ?>><?php echo $color->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="user" value="<?php echo $user->id; ?>">
                            <?php endforeach; ?>
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
