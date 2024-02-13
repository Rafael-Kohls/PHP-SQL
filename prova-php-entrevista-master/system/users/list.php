<?php
require '../../includes/connection.php';
include '../../templates/header.php';

$connection = new Connection();
$users = $connection->query("SELECT users.*,colors.name as color FROM users
LEFT JOIN user_colors on user_colors.user_id = users.id
LEFT JOIN colors on colors.id = user_colors.color_id
")->fetchAll(PDO::FETCH_OBJ);
?>
<style>
    .custom-btn {
        background-color: #ffa500; 
        border-color: #ffa500; 
        color: #ffffff; 
    }

    .custom-btn:hover {
        background-color: #ff7f00; /
        border-color: #ff7f00; 
    }
</style>

<div class="container mt-4 mx-auto">
    <!-- Botão para adicionar usuário -->
    <a href="create.php" class="btn btn-success mb-3">Adicionar Usuário</a>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Lista de Usuários
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr style='color:<?php echo $user->color; ?>'>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td>
                                <a href='update.php?id=<?php echo $user->id; ?>' class="btn btn-primary btn-sm">Editar</a>
                                <a href='delete.php?id=<?php echo $user->id; ?>' class="btn btn-danger btn-sm">Excluir</a>
                                <a href='read.php?id=<?php echo $user->id; ?>' class="btn btn-info btn-sm">Detalhar</a>
                                <a href='../setColorUser/setColor.php?user=<?php echo $user->id; ?>' class="btn btn-edit btn-sm custom-btn">Definir Cor</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../../templates/footer.php';
?>
