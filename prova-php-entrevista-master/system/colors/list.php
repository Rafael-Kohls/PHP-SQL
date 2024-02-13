<?php
require '../../includes/connection.php';
include '../../templates/header.php';

$connection = new Connection();
$colors = $connection->query("SELECT * FROM colors")->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-4 mx-auto">
    <a href="create.php" class="btn btn-success mb-3">Adicionar Cor</a>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Lista Cores
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">COR</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($colors as $color) : ?>
                        <tr>
                            <td style="color: <?php echo $color->name; ?>"><?php echo $color->id; ?></td>
                            <td style="color: <?php echo $color->name; ?>"><?php echo $color->name; ?></td>
                            <td>
                                <a href='update.php?id=<?php echo $color->id; ?>' class="btn btn-primary btn-sm">Editar</a>
                                <a href='delete.php?id=<?php echo $color->id; ?>' class="btn btn-danger btn-sm">Excluir</a>
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
