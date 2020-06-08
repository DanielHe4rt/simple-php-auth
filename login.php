<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=dev_crudlive", "danielhe4rt", "");

$query = $con->prepare("SELECT * FROM users WHERE email = :email");
$query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$query->execute();
if (!$query->rowCount()) {
    echo "essa conta não existe";
    return false;
}

$data = $query->fetch(PDO::FETCH_ASSOC);
$salt = md5('he4rtdevs');
$password = md5($_POST['password'] . $salt);
echo "Senha enviada: " . $password . "<br>";
echo "Senha do banco: " . $data['password'];
if ($password != $data['password']) {
    echo "senha incorreta";
    return false;
}
echo "login deu bom";
$_SESSION = $data;
$_SESSION['online'] = true;
header("location:dashboard.php");