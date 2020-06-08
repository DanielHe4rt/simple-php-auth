<?php
session_start();
if (!$_SESSION['online']) {
    header("location: index.html");
    return false;
}

if (!isset($_GET['userId'])) {
    header("location: dashboard.php");
    return false;
}

$con = new PDO("mysql:host=localhost;dbname=dev_crudlive", "danielhe4rt", "");
$query = $con->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam(':id', $_GET['userId'], PDO::PARAM_INT);
$query->execute();

if (!$query->rowCount()) {
    header("location: dashboard.php?error=1");
    return false;
}
$user = $query->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Melhor app da minha casa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Gerenciar</a>
            </li>
        </ul>
        <ul class="navbar-nav  my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Olá <?= $_SESSION['email'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <hr>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card  ">
                <div class="card-header">Gerenciar CRUD</div>
                <div class="card-body">
                    <table class="table">

                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td><?= $user['id'] ?></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><?= $user['email'] ?></td>
                            </tr>
                            <tr>
                                <td>Admin</td>
                                <td><?= $user['admin'] ? "Sim" : "Não" ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
