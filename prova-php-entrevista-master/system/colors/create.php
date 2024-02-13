<?php include '../../templates/header.php'; ?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Adicionar Cor
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="color" class="form-label">Selecione a Cor</label>
                    <!-- Campo de paleta de cores -->
                    <input type="color" class="form-control form-control-color" id="color" name="color" required style="width: 100px; height: 40px;">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Código da Cor</label>
                    <!-- Campo de texto para inserir o nome da cor -->
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<?php include '../../templates/footer.php'; ?>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../../includes/connection.php';
    $connection = new Connection();
    
    // Verifica se os campos nome e cor estão presentes no formulário
    if (isset($_POST['name']) && isset($_POST['color'])) {
        $name = trim($_POST['name']);
        $color = trim($_POST['color']);

        try {
            $query = "INSERT INTO colors (name) VALUES (:name)";
            $statement = $connection->prepare($query);

            // Vincula os parâmetros
            $statement->bindParam(':name', $name);

            // Executa a consulta
            if ($statement->execute()) {
                // Redireciona o usuário
                header("Location: list.php");
                exit;
            } else {
                echo "Erro ao inserir a cor.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>

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
