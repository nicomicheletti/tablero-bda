<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location:index.php");
} else{
    if($_SESSION['user']=="ok"){
        $userName=$_SESSION["userName"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>
<body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/BDA-2022" ?>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="<?php echo $url;?>/admin/home.php">Home</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/profesores.php">Profesores</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/clases.php">Clases</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/signout.php">Cerrar sesión</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver página de inicio</a>
        </div>
    </nav>
    <div class="container">
        <br/>
        <div class="row">