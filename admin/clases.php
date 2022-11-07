<?php include("template/header.php"); ?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";
$txtImg=(isset($_FILES['txtImg']['name']))?$_FILES['txtImg']['name']:"";
$action=(isset($_POST['action']))?$_POST['action']:"";

echo $txtID."<br/>";
echo $txtName."<br/>";
echo $txtImg."<br/>";
echo $action."<br/>";

switch($action){
    case "Agregar":
        //INSERT INTO `clases` (`id`, `name`, `img`) VALUES (NULL, 'Crossfit', 'crossfit.jpg');
        echo "Botón presionado";
        break;
    case "Modificar":
        echo "Botón presionado";
        break;
    case "Cancelar":
        echo "Botón presionado";
        break;
}
?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Tipos de clases
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" >
            <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtName">Clase</label>
            <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Clase">
            </div>

            <div class = "form-group">
            <label for="txtName">Imagen</label>
            <input type="file" class="form-control" name="txtImg" id="txtImg" placeholder="Img">
            </div>
            <br/>
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="action" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="action" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="action" value="Cancelar" class="btn btn-info">Cancelar</button>
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
                <th>Clase</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2</td>
                <td>Aprende php</td>
                <td>imagen.jpg</td>
                <td>Seleccionar | Borrar</td>
            </tr>
        </tbody>
    </table>
</div>
<?php include("template/footer.php"); ?>