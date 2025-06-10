<?php
include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação básica dos campos
    $nome = trim($_POST["nome"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $data_nascimento = trim($_POST["data_nascimento"] ?? '');
    $senha = $_POST["senha"] ?? '';
    $fone = trim($_POST["fone"] ?? '');

    if (empty($nome) || empty($email) || empty($data_nascimento) || empty($senha) || empty($fone)) {
        exit("Preencha todos os campos.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("E-mail inválido.");
    }

    // Verificar se o e-mail já existe
    $stmt = $mysqli->prepare("SELECT id_user FROM tb_usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        exit("E-mail já cadastrado.");
    }
    $stmt->close();

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO tb_usuarios (nome, email, data_nascimento, senha, fone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $data_nascimento, $senha_hash, $fone);

    if ($stmt->execute()) {
        echo "Usuário cadastrado!";
    } else {
        echo "Erro: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8');
    }
}
?>
