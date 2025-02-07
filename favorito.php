<?php
include('config.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Pegar o estado atual do favorito
    $query = "SELECT favorito FROM livros WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $favorito = $row['favorito'] ? 0 : 1; // Alterna entre 0 e 1

    // Atualizar o estado do favorito
    $updateQuery = "UPDATE livros SET favorito = $favorito WHERE id = $id";
    mysqli_query($conn, $updateQuery);

    echo json_encode(['success' => true, 'favorito' => $favorito]);
} else {
    echo json_encode(['success' => false]);
}
?>