<?php include("template/header.php"); ?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
$txtImg=(isset($_FILES['txtImg']['name']))?$_FILES['txtImg']['name']:"";
$action=(isset($_POST['action']))?$_POST['action']:"";

include("config/db.php");

switch($action){
    case "Agregar":
        $sentenciaSQL= $conection->prepare("INSERT INTO profesores (name, img ) VALUES (:name,:img );");
        $sentenciaSQL->bindParam(':name',$txtName);

        $fecha= new DateTime();
        $fileName=($txtImg!="")?$fecha->getTimestamp()."_".$_FILES["txtImg"]["name"]:"img.jpg";

        $tmpImg=$_FILES["txtImg"]["tmp_name"];
        if($tmpImg!=""){
            move_uploaded_file($tmpImg,"../img/".$fileName);
        }

        $sentenciaSQL->bindParam(':img',$fileName);
        $sentenciaSQL->execute();

        header("Location:profesores.php");
        break;

    case "Modificar":
        $sentenciaSQL= $conection->prepare("UPDATE profesores SET name=:name WHERE id=:id");
        $sentenciaSQL->bindParam(':name',$txtName);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImg!=""){
        $fecha= new DateTime();
        $fileName=($txtImg!="")?$fecha->getTimestamp()."_".$_FILES["txtImg"]["name"]:"img.jpg";

        $tmpImg=$_FILES["txtImg"]["tmp_name"];
        move_uploaded_file($tmpImg,"../img/".$fileName);

        $sentenciaSQL= $conection->prepare("SELECT img FROM profesores WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $profesor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($profesor["img"]) &&($profesor["img"]!="img.jpg")){
            if(file_exists("../img/".$profesor["img"])){
                unlink("../img/".$profesor["img"]);
            }
        }

        $sentenciaSQL= $conection->prepare("UPDATE profesores SET img=:img WHERE id=:id");
        $sentenciaSQL->bindParam(':img',$txtImg);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        }
        header("Location:profesores.php");
        break;
    case "Cancelar":
        header("Location:profesores.php");
        break;

    case "Seleccionar":
        $sentenciaSQL= $conection->prepare("SELECT * FROM profesores WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $profesor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtName=$profesor['name'];
        $txtImg=$profesor['img'];

        break;
    case "Borrar":
        $sentenciaSQL= $conection->prepare("SELECT img FROM profesores WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $profesor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($profesor["img"]) &&($profesor["img"]!="img.jpg")){
            if(file_exists("../img/".$profesor["img"])){
                unlink("../img/".$profesor["img"]);
            }
        }

        $sentenciaSQL= $conection->prepare("DELETE FROM profesores WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        header("Location:profesores.php");
    break;
}

    $sentenciaSQL= $conection->prepare("SELECT * FROM profesores");
    $sentenciaSQL->execute();
    $listaProfesores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Profesores
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" >
            <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text"  required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtName">Profesor</label>
            <input type="text" required class="form-control" value="<?php echo $txtName; ?>" name="txtName" id="txtName" placeholder="Nombre y Apellido">
            </div>

            <div class = "form-group">
            <label for="txtName">Imagen</label>
            <br/>

            <?php if($txtImg!=""){?>

                <img class="img-thumbnail rounded" src="../img/<?php echo $txtImg; ?>" width="50" alt="" srcset="">
            <?php
            }
            ?>

            <input type="file" class="form-control" name="txtImg" id="txtImg" placeholder="Img">
            </div>
            <br/>
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="action" <?php echo ($action=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="action" <?php echo ($action!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="action" <?php echo ($action!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="col-md-7">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Profesor</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach($listaProfesores as $profesores) { ?>
            <tr>
                <td><?php echo $profesores['id']; ?></td>
                <td><?php echo $profesores['name']; ?></td>
                <td>
                <img class="img-thumbnail rounded" src="../img/<?php echo $profesor['img']; ?>" width="50" alt="" srcset="">
                </td>
                <td>

                <form method="post">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $profesores['id']; ?>">
                    <input type="submit" name="action" value="Seleccionar" class="btn btn-primary"/>
                    <input type="submit" name="action" value="Borrar" class="btn btn-danger"/>

                </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("template/footer.php"); ?>