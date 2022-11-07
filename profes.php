<?php include("template/header.php"); ?>

<?php include("admin/config/db.php");

    $sentenciaSQL= $conection->prepare("SELECT * FROM profesores");
    $sentenciaSQL->execute();
    $listaProfesores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    ?>

<?php foreach($listaProfesores as $profesor) { ?>
    <div class="col-md-3">
    <div class="card">
    <img class="card-img-top" src="./img/<?php echo $profesor['img']; ?>" alt="">
        <div class="card-body">
        <h4 class="card-title"><?php echo $profesor['name']; ?></h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button">Ver mas</a>
    </div>
    </div>
    </div>
<?php } ?>
<?php include("template/footer.php"); ?>