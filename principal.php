<?php
    include 'mysqlConn.php';
    session_start();
    #region Validación de sesión
    sesionUsuario();
    restricSesionUsuario();
    // Revisando si el usuario es válido
    if (isset($_SESSION['valid'])){
        if ($_SESSION['valid'] == "No"){
            header ('Location: index.php');
        }
    }else{
        header ('Location: index.php');
    }
    #endregion
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Usuario: <?php echo $_SESSION["user"] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="imagen">
                    <img id="imgPerfil" src="obtenerImagen.php" alt="">
                </li>
            </ul>
            <form class="d-flex">
                <a class="btn btn-danger" href="cerrarSesion.php" type="submit">Cerrar Sesión</a>
            </form>
            </div>
        </div>
    </nav>
</head>
<body>
    <div class="card text-center">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
        <h5 class="card-title">Información de usuario</h5>
        <?php
            // Se obtiene la información del usuario
            $usuario = array();
            $usuario = obtenerInfo();
        ?>
        <br>
        <form id="infoForm" action="validacionInfoForm.php" onSubmit="return validarInfoForm()" class="row g-3" method="post"  enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre</label>
                <?php echo"<input type='text' class='form-control' id='nombre' name='nombre' value='". $usuario[0] ."' required>"; ?>
                <span id="nomError" class="error-message"></span>
            </div>
            <div class="col-md-4">
                <label for="app" class="form-label">Apellido paterno</label>
                <?php echo"<input type='text' class='form-control' id='app' name='app' value='". $usuario[1] ."' required>"; ?>
                <span id="appError" class="error-message"></span>
            </div>
            <div class="col-md-4">
                <label for="apm" class="form-label">Apellido materno</label>
                <?php echo"<input type='text' class='form-control' id='apm' name='apm' value='". $usuario[2] ."' required>"; ?>
                <span id="apmError" class="error-message"></span>
            </div>
            <div class="col-md-6">
                <label for="tel" class="form-label">Teléfono</label>
                <?php echo"<input type='text' class='form-control' id='tel' name='tel' value='". $usuario[3] ."' required>"; ?>
                <span id="telError" class="error-message"></span>
            </div>
            <div class="col-6">
                <label for="email" class="form-label">Email</label>
                <?php echo"<input type='email' class='form-control' id='email' name='email' value='". $usuario[4] ."' required>"; ?>
                <span id="emailError" class="error-message"></span>
            </div>
            <div class="col-4">
                <label for="img" class="form-label">Imagen de perfil: </label>
                <input type="file" class="form-control" id="img" name="img" accept="image/*">
                <span id="imgError" class="error-message"></span>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-outline-primary">Actualizar</button>
            </div>
            <br>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
    </div>
    <script src="validacionInfoForm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php 
// Funciones ------------------------------------------------------------------

#region Revisar sesion usuario
function sesionUsuario(){
    global $conn;
    try{
        $queryTok = "SELECT * FROM set_dispositivos 
        WHERE (ip != '" . $_SESSION["ip"] . "' 
        OR so != '" . $_SESSION["so"] . "' 
        OR nav != '" . $_SESSION["nav"] . "') 
        AND user = " . $_SESSION["user"] . " 
        AND actual = 'Si';";
        $res= $conn->query($queryTok);
        if ($res->num_rows > 0){
            // El usuario se encuentra en sesión en otro dispositivo
            while ($row = $res->fetch_assoc()){
                $token = $row["token"];
                if ($token != $_SESSION["token"]){
                    // El token no coincide
                    // Se cierra la otra sesión
                    cerrarSesion($token);
                    // Se valida la sesión
                    $_SESSION["valid"] = "Si";
                }
            }
        }else{
            // El usuario está libre de sesiones
        }
        $_SESSION["valid"] = "Si";
    }catch(Exception $ex){
        header('Location: index.php');
        //error
    }
}
#endregion

#region Restricción de sesion usuario
function restricSesionUsuario(){
    global $conn;
    try{
        $queryDisp = "SELECT * FROM set_dispositivos 
        WHERE ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . "
        AND token=" . $_SESSION["token"] . "  
        AND fecha='" . $_SESSION["fecha"] . "';";
        $resDisp = $conn->query($queryDisp);
        // Se revisa que exista un registro con ese dispositivo
        if ($resDisp->num_rows > 0){
            // Existe
            // Revisar si se encuentra validado
            while ($row = $resDisp->fetch_assoc()){
                $validAux = $row["actual"];
                if ($validAux == "Si"){
                    // Es la sesión actual
                    $_SESSION["valid"] = "Si";
                }else if($validAux == "No"){
                    // No es la sesión actual
                    $_SESSION["valid"] = "No";
                }
            }
        }else{
            // No Existe
            $_SESSION["valid"] = "No";
        }
    }catch(Exception $ex){
        header('Location: index.php');
        //error
    }
}
#endregion

#region Cerrar sesión
function cerrarSesion($token){
    global $conn;
    $queryValSes = "UPDATE set_dispositivos SET sesion='No', actual='No' WHERE token=" . $_SESSION["token"] . ";";
    $resValSes = $conn->query($queryValSes);
}
#endregion

#region mostrarInfo
function obtenerInfo(){
    global $conn;
    $infoUsuario = array();
    $queryinfo = "SELECT * FROM set_usuarios WHERE id=" . $_SESSION["user"] . ";";
    $resinfo = $conn->query($queryinfo);
    if ($resinfo->num_rows > 0){
        // Se encontró el usuario
        while ($row = $resinfo->fetch_assoc()){
            if (is_null($row["nombre"]) || $row["nombre"] == ""){
                array_push($infoUsuario,"Nombre");
            }else{
                array_push($infoUsuario,$row["nombre"]);
            }
            if (is_null($row["apPaterno"]) || $row["apPaterno"] == ""){
                array_push($infoUsuario,"Apellido paterno");
            }else{
                array_push($infoUsuario,$row["apPaterno"]);
            }
            if (is_null($row["apMaterno"]) || $row["apMaterno"] == ""){
                array_push($infoUsuario,"Apellido materno");
            }else{
                array_push($infoUsuario,$row["apMaterno"]);
            }
            if (is_null($row["telefono"]) || $row["telefono"] == "" || $row["telefono"] == "0"){
                array_push($infoUsuario,"Teléfono");
            }else{
                array_push($infoUsuario,$row["telefono"]);
            }
            if (is_null($row["email"]) || $row["email"] == ""){
                array_push($infoUsuario,"Email");
            }else{
                array_push($infoUsuario,$row["email"]);
            }
        }
    }else{
        // No hay registros
    }
    return $infoUsuario;
}
#endregion

?>