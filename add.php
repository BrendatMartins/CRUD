<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano_publicacao'];
    $status = isset($_POST['status']) && $_POST['status'] === 'on' ? 'Lido' : 'Não Lido';

    $sql = "INSERT INTO livros (titulo, autor, genero, ano_publicacao, status)
            VALUES ('$titulo', '$autor', '$genero', '$ano', '$status')";
    $conn->query($sql);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Série</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="container mt-4">

    <a href="index.php" id="backButton" class="btn-back">←</a>
    <button id="toggleDarkMode">🌙</button>

    <div class="container">
        <h1>Adicionar Novo Livro</h1>
        <form method="POST" class="form-container">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required class="form-control" required>
            </div>

            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" required class="form-control" required>
            </div>

            <div class="form-group">
                <label for="genero">Gênero:</label>
                <input type="text" name="genero" id="genero" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ano_publicacao">Ano:</label>
                <input type="number" name="ano_publicacao" id="ano_publicacao" class="form-control" required>
            </div>

            <label>Status:</label>
            <div class="form-switch">
                <input class="form-check-input" type="checkbox" id="statusSwitch" name="status" value="on">
                <label class="form-check-label" for="statusSwitch"></label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const titulo = document.querySelector('input[name="titulo"]');
            const autor = document.querySelector('input[name="autor"]');
            const genero = document.querySelector('input[name="genero"]');
            const ano = document.querySelector('input[name="ano_publicacao"]');
            const status = document.querySelector('#statusSwitch').checked ? 'Lido' : 'Não Lido';

            const anoAtual = new Date().getFullYear(); // Obtém o ano atual
            let valido = true;

            function mostrarErro(input, mensagem) {
                input.setCustomValidity(mensagem);
                input.reportValidity();
                valido = false;
            }

            titulo.setCustomValidity('');
            autor.setCustomValidity('');
            genero.setCustomValidity('');
            ano.setCustomValidity('');

            // Validações
            if (titulo.value.trim() === '') mostrarErro(titulo, 'Preencha o título.');
            if (autor.value.trim() === '') mostrarErro(autor, 'Preencha o autor.');
            if (genero.value.trim() === '') mostrarErro(genero, 'Preencha o gênero.');
            if (ano.value.trim() === '') {
                mostrarErro(ano, 'Preencha o ano.');
            } else if (ano.value < 0 || ano.value > anoAtual) {
                mostrarErro(ano, `O ano deve ser entre 0 e ${anoAtual}.`);
            }

            if (!valido) event.preventDefault(); // Impede o envio do formulário se houver erros
        });
    </script>

    <script>
        const toggleButton = document.getElementById('toggleDarkMode');
        const body = document.body;

        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
        }

        toggleButton.addEventListener('click', function () {
            body.classList.toggle('dark-mode');

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

        atualizarLabel();

        statusSwitch.addEventListener('change', atualizarLabel);
    });
    </script>
</body>
</html>

