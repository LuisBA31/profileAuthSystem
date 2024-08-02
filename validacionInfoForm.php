<?php

include 'mysqlConn.php';
session_start();

// Información del usuario
$nom = $_POST["nombre"];
$app = $_POST["app"];
$apm = $_POST["apm"];
$tel = $_POST["tel"];
$email = $_POST["email"];

// Verificación de dominio y petición
if (domValid() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (datosValidos()){
        // Los datos ingresados son válidos
        infoControl();
    }else{
        // Los datos no son válidos
        header('Location: principal.php');
    }
}else{
    header('Location: index.php');
}

// Funciones ------------------------------------------------------

#region Validar datos form
function datosValidos(){
    global $nom, $app, $apm, $tel, $email;
    if (is_numeric($nom) || $nom == "Nombre" || $nom == ""){
        return false;
    }
    if (is_numeric($app) || $app == "Apellido paterno" || $app == ""){
        return false;
    }
    if (is_numeric($apm) || $apm == "Apellido materno" || $apm == ""){
        return false;
    }
    if (!validNum($tel)){
        return false;
    }
    if (is_numeric($email)){
        return false;
    }
    return true;
}
#endregion

#region Validar numero
function validNum($num){
    $n = strlen((string)$num);
    if ($n < 10 || $n > 10){
        return false;
    }else{
        return true;
    }
}
#endregion

#region Control
function infoControl(){
    if (tokenValido()){
        // El token activo es válido
        // Se actualiza el registro
        actualizarDatos();
        actualizarImagen();
        header('Location: principal.php');
    }else{
        // El token activo no es válido
        header('Location: index.php');
    }
}
#endregion

#region Validar token actual
function tokenValido(){
    global $conn;
    try{
        // Se obtiene el token de la sesión actual del usuario
        $queryToken = "SELECT * FROM set_dispositivos WHERE user=" . $_SESSION["user"] ." AND actual='Si';";
        $res = $conn->query($queryToken);
        if ($res->num_rows > 0){
            // Hay usuario activo
            while ($row = $res->fetch_assoc()){
                $token = $row["token"];
                if ($token == $_SESSION["token"]){
                    // El token es válido
                    return true;
                }else{
                    // El token no es válido
                    return false;
                }
            }
        }else{
            // No hay usuario activo
            return false;
        }
    }catch(Exception $ex){
        // Err
        return false;
    }
}
#endregion

#region Actualizar datos usuario
function actualizarDatos(){
    global $conn,$nom, $app, $apm, $tel, $email;
    $queryActualizar = "UPDATE set_usuarios 
    SET nombre='$nom', apPaterno='$app', apMaterno='$apm', telefono=$tel, email='$email' WHERE id=" . $_SESSION["user"] .";";
    $resAct = $conn->query($queryActualizar);
}
#endregion

#region Actualizar imagen usuario
function actualizarImagen() {
    global $conn;
    try {
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $imagen = $_FILES['img']['tmp_name'];
            $contenido = file_get_contents($imagen); // Eliminar addslashes
            $tipo = $_FILES['img']['type'];
            // Se asigna el nombre
            $nombre = "usuario" . $_SESSION["user"] . "." . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

            // Se verifica que el tipo de la imagen sea válido
            if (tipoImagenValido($tipo)) {

                // Se define la acción a realizar con la imagen
                if (existeImagen()) {
                    // Actualizar imagen en la base de datos
                    $sqlImg = "UPDATE set_imagenes SET imagen=?, tipo=?, nombre=? WHERE id=?";
                    $resp = $conn->prepare($sqlImg);
                    $resp->bind_param("sssi", $contenido, $tipo, $nombre, $_SESSION["user"]);
                } else {
                    // Insertar imagen en la base de datos
                    $sqlImg = "INSERT INTO set_imagenes (id, imagen, tipo, nombre) VALUES (?, ?, ?, ?)";
                    $resp = $conn->prepare($sqlImg);
                    $resp->bind_param("isss", $_SESSION["user"], $contenido, $tipo, $nombre);
                }
                // Ejecutar la consulta
                if ($resp->execute()) {
                    // Se subió la imagen
                } else {
                }
                $resp->close();
            } else {
                // Tipo de imagen no válido
            }
        } else {
            // No es válida la imagen o no existe
        }
    } catch (Exception $ex) {
        // err
    }
}

#endregion

#region Validar extensión de imagen
function tipoImagenValido($tipo){
    if ($tipo == "image/jpg" || $tipo == "image/png" || $tipo == "image/jpeg"){
        // La extensión es válida
        return true;
    }else{
        // La extensión no es válido
        return false;
    }
}
#endregion

#region Validar existencia imagen
function existeImagen(){
    global $conn;
    try{
        $queryImg = "SELECT * FROM set_imagenes WHERE id=" . $_SESSION["user"] .";";
        $resImg = $conn->query($queryImg);
        if ($resImg->num_rows > 0){
            // Existe la imagen
            return true;
        }else{
            // No existe la imagen
            return false;
        }
    }catch(Exception $ex){
        // err
        return false;
    }
}
#endregion

#region Validar dominio
function domValid() {
    $host = $_SERVER['HTTP_HOST'];
    return $host === 'localhost' || $host === '127.0.0.1';
}
#endregion

?>