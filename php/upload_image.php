<?php
session_start();
include("conecta.php");

if (!isset($_SESSION["id_user"])) {
    exit("Você precisa estar logado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $id_user = $_SESSION["id_user"];
    $data_img = date("Y-m-d");
    $titulo = trim($_POST["titulo"] ?? '');
    $sub_titulo = trim($_POST["sub_titulo"] ?? '');
    $descricao = trim($_POST["descricao"] ?? '');
    $local = trim($_POST["local"] ?? '');

    // Validação dos campos
    if (empty($titulo) || empty($descricao) || empty($local)) {
        exit("Preencha todos os campos obrigatórios.");
    }

    // Validação do arquivo
    $nome_arquivo = basename($_FILES["imagem"]["name"]);
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
    $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $tipos_permitidos)) {
        exit("Tipo de arquivo não permitido.");
    }
    if ($_FILES["imagem"]["size"] > 5*1024*1024) { // 5MB
        exit("Arquivo muito grande. Máximo 5MB.");
    }

    // Garante nome único para o arquivo
    $novo_nome = uniqid('img_', true) . '.' . $extensao;
    $destino = "uploads/" . $novo_nome;

    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $destino)) {
        $stmt = $mysqli->prepare("INSERT INTO tb_imagens (id_user, url_img, data_img, titulo, sub_titulo, descricao, local) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $id_user, $destino, $data_img, $titulo, $sub_titulo, $descricao, $local);
        $stmt->execute();
        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar imagem.";
    }
}
?>
