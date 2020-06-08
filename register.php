<?php

//var_dump($_POST);

$con = new PDO("mysql:host=localhost;dbname=dev_crudlive", "danielhe4rt", "");

$query = $con->prepare("SELECT * FROM users WHERE email = :email");
$query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$query->execute();
if ($query->rowCount()) {
    echo "já existe um registro com esse e-mail";
    return false;
}

$salt = md5('he4rtdevs');
$password = md5($_POST['password'] . $salt);

$query = $con->prepare("INSERT INTO users VALUES (null,:email,:password,0,null)");
$query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
if($query->execute()){
    echo "cabo deu bom";
    return true;
}
echo "deu merda";

