<?php require_once 'DAO.php'; ?>
<?php require_once 'user.php'; ?>

<?php
$nome = $_POST["novoNome"];
$senha = $_POST["novaSenha"];
$email = $_POST["novoEmail"];
$emailAntigo = $_POST["emailAntigo"];

$alterar = new user();
$alterar->setNome($nome);
$alterar->setSenha($senha);
$alterar->setEmail($email);

$DAO = new DAO();
$DAO->alterar($alterar, $emailAntigo, $conn);
?>








