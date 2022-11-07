<?php
session_start();
if($_POST){
    if(($_POST['user']=="admin")&&($_POST['password']=="admin")){
        $_SESSION['user']="ok";
        $_SESSION['userName']="admin";
        header('Location:home.php');
    }else{
        $message="Usuario o contraseña inválidos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            <br/><br/><br/><br/>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                    <?php	if(isset($message)) {?>
                    <div class="alert alert-danger" role="alert">
                            <?php echo $message; ?>
                    <?php } ?>
                        </div>
                        <form method="POST">
                        <div class = "form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" class="form-control" name="user" placeholder="Enter user">
                        </div>
                        <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>