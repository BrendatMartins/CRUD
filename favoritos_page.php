<?php
include('config.php');
$result = mysqli_query($conn, "SELECT * FROM livros WHERE favorito = 1");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Favoritos 📚</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-4">

    <a href="index.php" id="backButton" class="btn-back">←</a>
    <button id="toggleDarkMode">🌙</button>

    <h1 class="mb-4">⭐ Meus Favoritos</h1>

    <table>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Gênero</th>
            <th>Ano</th>
            <th>Status</th>
        </tr>
        <?php while($livro = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($livro['titulo']) ?></td>
                <td><?= htmlspecialchars($livro['autor']) ?></td>
                <td><?= htmlspecialchars($livro['genero']) ?></td>
                <td><?= $livro['ano_publicacao'] ?></td>
                <td><?= $livro['status'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

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
</body>
</html>