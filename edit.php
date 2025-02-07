<?php
include('config.php');

// Recupera o ID do livro que será editado
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM livros WHERE id = $id");
$livro = $result->fetch_assoc();

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano_publicacao'];
    
    // Verifica se o checkbox "status" está marcado e atribui o valor "Lido", caso contrário, "Não Lido"
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Lido' : 'Não Lido';

    // Atualiza os dados do livro no banco de dados
    $sql = "UPDATE livros SET titulo='$titulo', autor='$autor', genero='$genero', ano_publicacao='$ano', status='$status' WHERE id=$id";
    $conn->query($sql);

    // Redireciona para a página de listagem após a atualização
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-4">

    <!-- Botão de retorno -->
    <a href="index.php" id="backButton" class="btn-back">←</a>
    
    <!-- Toggle de modo escuro -->
    <button id="toggleDarkMode" class="btn btn-light">🌙</button>

    <div class="container">
        <h1>Editar Livro</h1>
        <form method="POST" class="form-container">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="<?= $livro['titulo'] ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" value="<?= $livro['autor'] ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="genero">Gênero:</label>
                <input type="text" name="genero" id="genero" value="<?= $livro['genero'] ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="ano_publicacao">Ano de Publicação:</label>
                <input type="number" name="ano_publicacao" id="ano_publicacao" value="<?= $livro['ano_publicacao'] ?>" class="form-control">
            </div>

            <label>Status:</label>
            <div class="form-switch">
                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="on" <?= $livro['status'] === 'Lido' ? 'checked' : '' ?>>
                <label class="form-check-label" for="statusSwitch">Lido</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Salvar Alterações</button>
        </form>
    </div>
    <script>
        // Modo escuro
        const toggleButton = document.getElementById('toggleDarkMode');
        const body = document.body;

        // Verifica se o modo escuro estava ativado anteriormente
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
        }

        toggleButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');

            // Salva a preferência no localStorage
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSwitch = document.getElementById('statusSwitch');
            const statusLabel = document.querySelector('label[for="statusSwitch"]');

            function atualizarLabel() {
                statusLabel.textContent = statusSwitch.checked ? 'Lido' : 'Não Lido';
            }

            // Atualiza o texto ao carregar a página, caso o switch já esteja ativado
            atualizarLabel();

            // Atualiza o texto ao alterar o switch
            statusSwitch.addEventListener('change', atualizarLabel);
        });
    </script>
</body>
</html>
