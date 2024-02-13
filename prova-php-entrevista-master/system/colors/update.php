<?php include '../../templates/header.php'; ?>

<?php
    require '../../includes/connection.php';
    $connection = new Connection();
    

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['name']) && isset($_POST['color'])) {
            $name = trim($_POST['name']);
            $color = trim($_POST['color']);

            try {
                $query = "UPDATE colors SET name = :name WHERE id = :id";
                $statement = $connection->prepare($query);

                // Vincula os parâmetros
                $statement->bindParam(':name', $name);
                $statement->bindParam(':id', $id);

                if ($statement->execute()) {
                    header("Location: list.php");
                    exit;
                } else {
                    echo "Erro ao atualizar a cor.";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        } else {
            echo "Por favor, preencha todos os campos.";
        }
    }

    // Obtém os dados da cor com base no ID
    $query = "SELECT * FROM colors WHERE id = :id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':id', $id);

    try {
        $statement->execute();
        $color = $statement->fetch();
    } catch(PDOException $e) {
        echo "Erro ao obter dados da cor: " . $e->getMessage();
    }
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Editar Cor
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="color" class="form-label">Selecione a Cor</label>
                    <!-- Campo de paleta de cores -->
                    <input type="color" class="form-control form-control-color" id="color" name="color" value="<?php echo $color['name']; ?>" required style="width: 100px; height: 40px;">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Código da Cor</label>
                    <!-- Campo de texto para inserir o nome da cor -->
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $color['name']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Atualizar</button>
            </form>
        </div>
    </div>
</div>
<script>
    const colorInput = document.getElementById('color');
    const nameInput = document.getElementById('name');

    colorInput.addEventListener('input', function() {
        // Atualiza o valor do campo de texto com o valor selecionado na paleta de cores
        nameInput.value = colorInput.value;
    });

    nameInput.addEventListener('input', function() {
        // Atualiza o valor da paleta de cores com o valor inserido no campo de texto
        colorInput.value = nameInput.value;
    });
</script>


<?php include '../../templates/footer.php'; ?>
