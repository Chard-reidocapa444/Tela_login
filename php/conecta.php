<?php  
	$domain = "localhost";   // Localização do servidor
	$user = "root";          // Usuário do banco de dados
	$password = "";          // Senha do banco de dados
	$database = "bd_drone"; // Nome do banco de dados

	// Criando a conexão com o banco de dados
	$mysqli = new mysqli($domain, $user, $password, $database);

	// Verifica se houve erro na conexão
	if ($mysqli->connect_errno) {
    	exit("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
	}

	// Definir o charset para evitar problemas com acentos
	define('CHARSET', 'utf8');
	$mysqli->set_charset(CHARSET);
?>