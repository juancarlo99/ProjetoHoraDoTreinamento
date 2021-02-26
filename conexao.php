<?php 

$servidor = "Localhost";
$usuario = "root";
$senha = "";
$dbname = "projetoteste";
//faz a conexão com o banco de dados e armazena em uma variavel para ser usados nas querys

$conn = mysqli_connect($servidor, $usuario, $senha, $dbname); 
if(!$conn){
	die("Falha na conexao: " . mysqli_connect_error());
}else{
	
}

?>