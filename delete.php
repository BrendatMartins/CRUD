<?php
include('config.php');

$id = $_GET['id'];
$conn->query("DELETE FROM livros WHERE id = $id");

header('Location: index.php');
exit();
?>
