<?php require_once 'DAO.php'; ?>
<?php require_once 'user.php'; ?>
<?php

$nome = $_POST["nome"];
$senha = $_POST["senha"];
$email = $_POST["email"];


$insert = new user();
$insert->setNome($nome);
$insert->setEmail($email);
$insert->setSenha($senha);

$DAO = new DAO();

$DAO->insertUser($insert, $conn);
$DAO->logar($logar, $conn);
?>







