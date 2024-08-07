<?php
    include 'mysqlConn.php';
    session_start();
    #region Revisar sesión válida
    if(!usuarioExiste() || !sesionUsuario() || !domValid()){
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
    <title>Dashboard</title>
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
    <br>
    <div class="card-body">
        <h5 class="card-title">Información de usuario</h5>
        <?php
            // Se obtiene la información del usuario
            $usuario = array();
            $usuario = obtenerInfoUsuario();
            $sesion = ultimaSesion();
        ?>
        <br>
        <form id="infoForm" action="validacionInfoForm.php" onSubmit="return validarInfoForm()" class="row g-3" method="post"  enctype="multipart/form-data">
            <input type="text" id="token" name="token" value=<?php echo $_SESSION["token"] ?> required hidden>
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
    <br>
    </div>
    <div class="card text-center">
    <div class="card-header">
        Dispositivos enlazados
    </div>
    <br>
    <div class="card-body">
        <h5 class="card-title">Información de dispositivos</h5>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">IP</th>
                <th scope="col">Sistema operativo</th>
                <th scope="col">Navegador</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col">Validado</th>
                <th scope="col">En sesión</th>
                <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php MostrarDispositivos() ?>
            </tbody>
        </table>
    </div>
    <br>
    </div>
    <div class="card text-center">
    <div class="card-header">
        Última sesión
    </div>
    <br>
    <div class="card-body">
        <p>
        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#ultimaSesion" role="button" aria-expanded="false" aria-controls="collapseExample">
            Consultar
        </a>
        </p>
        <div class="collapse" id="ultimaSesion">
            <div class="card card-body">
                <?php echo "Tu última sesión fué el $sesion" ?>
            </div>
        </div>
    </div>
    </div>
    <div class="card-footer text-muted"><br></div>
    <script src="validacionInfoForm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php 
// Funciones ------------------------------------------------------------------

#region Revisar si existe un usuario
function usuarioExiste(){
    global $conn;
    try{
        $query = "SELECT * FROM set_dispositivos
        WHERE usuario = ?";
        $consult = $conn->prepare($query);
        $consult->bind_param("i", $_SESSION["user"]);
        $consult->execute();
        $result = $consult->get_result();
        if ($result->num_rows > 0){
            // Existe el usuario
            return true;
        }else{
            // No existe el usuario
            return false;
        }
    }catch(Exception $ex){
        // Err
        header('Location: index.php');
    }
}
#endregion

#region Revisar sesion usuario
function sesionUsuario(){
    global $conn;
    try{
        $queryTok = "SELECT * FROM set_dispositivos 
        WHERE ip = ? 
        AND so = ? 
        AND nav = ? 
        AND usuario = ? ";
        $consult = $conn->prepare($queryTok);
        $consult->bind_param("sssi", $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["user"]);
        $consult->execute();
        $result = $consult->get_result();
        if ($result->num_rows > 0){
            // El usuario se encuentra en sesión en otro dispositivo
            while ($row = $result->fetch_assoc()){
                $token = $row["token"];
                $actual = $row["actual"];
                if ($token != $_SESSION["token"] || $actual != "Si"){
                    // El token no coincide o no es la sesión actual
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            // El usuario está libre de sesiones
            return true;
        }
    } catch(Exception $ex){
        header('Location: index.php');
        //error
    }
}
#endregion

#region Obtener información de usuario
function obtenerInfoUsuario(){
    global $conn;
    $infoUsuario = array();

    $queryinfo = "SELECT nombre, apPaterno, apMaterno, telefono, email FROM set_usuarios WHERE usuario = ?";
    $consult = $conn->prepare($queryinfo);
    $consult->bind_param("i", $_SESSION["user"]);
    $consult->execute();
    $result = $consult->get_result();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $infoUsuario[] = is_null($row["nombre"]) || $row["nombre"] == "" ? "Nombre" : $row["nombre"];
            $infoUsuario[] = is_null($row["apPaterno"]) || $row["apPaterno"] == "" ? "Apellido paterno" : $row["apPaterno"];
            $infoUsuario[] = is_null($row["apMaterno"]) || $row["apMaterno"] == "" ? "Apellido materno" : $row["apMaterno"];
            $infoUsuario[] = is_null($row["telefono"]) || $row["telefono"] == "" || $row["telefono"] == "0" ? "Teléfono" : $row["telefono"];
            $infoUsuario[] = is_null($row["email"]) || $row["email"] == "" ? "Email" : $row["email"];
        }
    }
    return $infoUsuario;
}
#endregion

#region Obtener información de dispositivos
function MostrarDispositivos(){
    global $conn;
    $n=0;
    $class="";
    $button="";

    $queryDisp = "SELECT * FROM set_dispositivos WHERE usuario = ?";
    $consult = $conn->prepare($queryDisp);
    $consult->bind_param("i", $_SESSION["user"]);
    $consult->execute();
    $result = $consult->get_result();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $n++;
            $class = $row["actual"] == "Si" ? "table-secondary" : "table-light";
            $button = $row["actual"] == "Si" ? "'btn-close' disabled" : "'btn-close'" ;
            echo 
            "<tr class='$class'>
            <th scope='row'>$n</th>
            <td>".$row["ip"]."</td>
            <td>".$row["so"]."</td> 
            <td>".$row["nav"]."</td>
            <td>".$row["fecha"]."</td>
            <td>".$row["valid"]."</td>
            <td>".$row["actual"]."</td>
            <td>
                <form id='dispForm' action='eliminarDisp.php' method='post'>
                <input type='text' id='tokenDisp' name='tokenDisp' value=" . $row["token"] . " required hidden>
                <button type='submit' class=$button aria-label='Close'></button>
                </form>
            </td>
            </tr>";
        }
    }
}
#endregion

#region Obtener ultima sesión

function ultimaSesion(){
    global $conn;
    $sesion="";
    $id=0;
    $aux=false;

    $querySesion = "SELECT * FROM set_sesiones WHERE sesion='si' ORDER BY idSesion DESC LIMIT 2";
    $consult = $conn->prepare($querySesion);
    $consult->execute();
    $result = $consult->get_result();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $id = $row["idSesion"];
        }
    }

    $sesion = sesion($id);

    return $sesion;
}

function sesion($id){
    global $conn;
    $querySesion = "SELECT * FROM set_sesiones WHERE idSesion=$id";
    $consult = $conn->prepare($querySesion);
    $consult->execute();
    $result = $consult->get_result();

    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $info= $row["fecha"] . "<br> en el dispositivo:<br>" . $row["dispositivo"];
        }
    }
    return $info;
}

#endregion

#region Validar dominio
function domValid() {
    $host = $_SERVER['HTTP_HOST'];
    return $host === 'localhost' || $host === '127.0.0.1';
}
#endregion

?>