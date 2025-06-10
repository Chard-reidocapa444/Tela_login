<?php
session_start();
include("conecta.php");

if (!isset($_SESSION["id_user"])) {
    exit("Você precisa estar logado.");
}

$id_user = $_SESSION["id_user"];

// Usar prepared statement para evitar SQL Injection
$stmt = $mysqli->prepare("SELECT url_img, titulo, descricao FROM tb_imagens WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>Minhas Imagens</h1>";
while ($img = $result->fetch_assoc()) {
    // Escapar saída para evitar XSS
    $url_img = htmlspecialchars($img['url_img'], ENT_QUOTES, 'UTF-8');
    $titulo = htmlspecialchars($img['titulo'], ENT_QUOTES, 'UTF-8');
    $descricao = htmlspecialchars($img['descricao'], ENT_QUOTES, 'UTF-8');
    echo "<div>";
    echo "<img src='{$url_img}' width='300'><br>";
    echo "<strong>{$titulo}</strong> - {$descricao}<br><hr>";
    echo "</div>";
}
?>
