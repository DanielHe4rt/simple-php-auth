<?php
session_start();
if (!$_SESSION['online']) {
    header("location: index.html");
    return false;
}

if (!$_SESSION['admin']) {
    header("location: index.html");
    return false;
}

$con = new PDO("mysql:host=localhost;dbname=dev_crudlive", "danielhe4rt", "");

$query = $con->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam(":id", $_POST['userId'], PDO::PARAM_INT);
$query->execute();

if (!$query->rowCount()) {
    header("location: https://pudim.com.br");
    return false;
}

$query = $con->prepare("UPDATE users SET email = :email WHERE id = :id");
$query->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
$query->bindParam(":id", $_POST['userId'], PDO::PARAM_INT);
if(!$query->execute()){
    echo "deu merda";
    return false;
}

header("location: gerenciar.php");