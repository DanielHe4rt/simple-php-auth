<?php
session_start();
if (!$_SESSION['online']) {
    header("location: index.html");
    return false;
}
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
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Email</td>
                            <td>Admin</td>
                            <td>Ações</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $con = new PDO("mysql:host=localhost;dbname=dev_crudlive", "danielhe4rt", "");
                        $query = $con->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 10");
                        $query->execute();
                        $users = $query->fetchAll(PDO::FETCH_ASSOC);
                        if (!count($users)) {
                            ?>
                            <tr>
                                <td colspan="4">Não há registros</td>
                            </tr>
                            <?php
                        }
                        foreach($users as $user){
                            ?>
                            <tr>
                                <td> <?= $user['id'] ?></td>
                                <td> <?= $user['email'] ?></td>
                                <td> <?= $user['admin'] ? "Sim" : "Não" ?></td>
                                <td>
                                    <a class="btn btn-primary" href="read.php?userId=<?= $user['id'] ?>">Ver</a>
                                    <a class="btn btn-primary" href="edit.php?userId=<?= $user['id'] ?>">Editar</a>
                                    <?php
                                    if(!$user['admin']){
                                    ?>
                                        <button class="btn btn-danger">Deletar</button>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
