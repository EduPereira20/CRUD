
<?php require_once 'DAO.php'; ?>
<?php require_once 'user.php'; ?>

<?php
$email = $_POST["email"];
$senha = $_POST["senha"];

$logar = new user();
$logar->setEmail($email);
$logar->setSenha($senha);

$DAO = new DAO();
$DAO->logar($conn, $logar);
?>
