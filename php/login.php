<?php
session_start();
include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? '');
    $senha = $_POST["senha"] ?? '';

    if (empty($email) || empty($senha)) {
        exit("Preencha todos os campos.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("E-mail inválido.");
    }

    $stmt = $mysqli->prepare("SELECT id_user, senha FROM tb_usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id_user, $senha_hash);
    if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
        $_SESSION["id_user"] = $id_user;
        // Redirecionar para upload
        header("Location: form_upload.html");
        exit();
    } else {
        echo "Email ou senha inválidos.";
    }
}
?>
