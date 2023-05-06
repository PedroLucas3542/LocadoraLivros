<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "wda"; 

// Cria uma conexão com o banco de dados
$conn = mysqli_connect($host, $username, $password, $dbname);

// Verifica a conexão
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

?>