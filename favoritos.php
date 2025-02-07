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
            <th>Ações</th>
            <th>Favorito</th>
        </tr>
        <?php while($livro = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($livro['titulo']) ?></td>
                <td><?= htmlspecialchars($livro['autor']) ?></td>
                <td><?= htmlspecialchars($livro['genero']) ?></td>
                <td><?= $livro['ano_publicacao'] ?></td>
                <td><?= $livro['status'] ?></td>
                <td class="acoes-cell">
                    <div class="acoes">
                        <a href="edit.php?id=<?= $livro['id'] ?>" class="editar-link">Editar ✏️</a>
                        <a href="delete.php?id=<?= $livro['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="excluir-link">
                            Excluir 🗑️
                        </a>
                    </div>
                </td>
                <td class="favorito-cell">
                    <button class="favorito-btn" 
                        data-id="<?= $livro['id'] ?>" 
                        data-favorito="<?= $livro['favorito'] ?>">
                        <?= $livro['favorito'] ? '⭐' : '☆' ?>
                    </button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        document.querySelectorAll('.favorito-btn').forEach(button => {
            button.addEventListener('click', function () {
                const livroId = this.getAttribute('data-id');

                fetch('favorito.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=' + livroId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.innerHTML = data.favorito ? '⭐' : '☆';
                        location.reload(); // Atualiza a página para remover livros não favoritos
                    }
                });
            });
        });
    </script>
    <script>
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
</body>
</html>