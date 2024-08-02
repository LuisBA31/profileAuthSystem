<?php

include 'mysqlConn.php';
session_start();

$_SESSION['user'] = $_POST['idUsr'];
$_SESSION['passwd'] = $_POST['passwd'];

// Valores del usuario
$id = $_POST['idUsr'];
$passw = $_POST['passwd'];

// Verificación de dominio y petición
if (domValid() || $_SERVER['REQUEST_METHOD'] === 'POST') {
    if(validDatos()){
        validControl();
    }else{
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}

// Funciones ------------------------------------------------------

#region Validar formulario
function validDatos(){
    global $id, $passw;
    // Validar usuario y contraseña
    if (is_numeric($id)) {
        if (strlen($passw) >= 4) {
            // Ambos campos validados
            // Se procede a validar en la bdd
            return true;
        } else {
            // Passw incorrecta
            return false;
        }
    } else {
        // id incorrecto
        return false;
    }
}
#endregion

#region Control
function validControl() {
    global $conn;
    if (logIn()) {
        // Usuario y contraseña válidos
        // Se verifica que no exceda las 4 sesiones
        if (revisarSesion()){
            // El usuario se encuentra libre de sesiones
            // Se actualiza el token
            actualizarToken();
            // Se asignan las demás sesiones como no activas
            desactivarDispositivos();
            // Se revisa el estado del usuario y el dispositivo
            switch (revisarDisp()){
                case 1:
                    // El dispositivo existe y está validado
                    // Se inserta la sesión
                    setSesion();
                    // Se redirecciona a la página principal
                    validarSesion();
                    validarSesionDisp();
                    header('Location: principal.php');
                    break;
                case 2:
                    // El dispositivo existe y no está validado
                    // Se crea un nuevo pin
                    $_SESSION["pin"] = generarPin();
                    // Se actualiza el token y la sesión del dispositivo
                    actualizarDispositivo();
                    // Se agrega una sesión
                    setSesion();
                    header('Location: pinForm.php');
                    break;
                case 3:
                    // El dispositivo no existe
                    // Se genera un PIN para el dispositivo
                    $_SESSION["pin"] = generarPin();
                    // Se agrega el dispositivo
                    registrarDispositivo();
                    // Se agrega una sesión
                    setSesion();
                    header('Location: pinForm.php');
                    break;
                default:
                    // Error
                    header('Location: index.php');
                    break;
            }
        }else{
            // Excedió los 4 intentos
            header('Location: index.php');
        }
    } else {
        // Se agrega una sesión?
        header('Location: index.php');
    }
}
#endregion

#region LogIn
function logIn() {
    global $id, $passw, $conn;
    try {
        $consult = $conn->prepare("SELECT pw FROM set_usuarios WHERE usuario=?");
        $consult->bind_param("i", $id);
        $consult->execute();
        $res = $consult->get_result();
        if ($res->num_rows > 0) {
            // validar constraseña
            while ($row = $res->fetch_assoc()) {
                $passwAux = $row["pw"];
                if (password_verify($passw, $passwAux)) {
                    // Coinciden las contraseñas
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            // No hay registros
            return false;
        }
    } catch (Exception $ex) {
        // Manejar excepción
    }
}
#endregion

#region Revisar sesión
function revisarSesion() {
    global $conn;
    $consult = $conn->prepare("SELECT * FROM set_sesiones WHERE usuario=? AND fecha=? AND sesion='No'");
    $consult->bind_param("is", $_SESSION["user"], $_SESSION["fecha"]);
    $consult->execute();
    $resDisp = $consult->get_result();
    // Se revisa si hay más de 4 sesiones
    if ($resDisp->num_rows < 4) {
        // Hay menos de 4, se registra
        return true;
    }else{
        // Hay más de 4, no se registra
        return false;
    }
}
#endregion

#region Revisar dispositivos
function revisarDisp() {
    global $conn;
    try{
        $estado = 0;
        // Consulta del dispositivo
        $consult = $conn->prepare("SELECT * FROM set_dispositivos 
        WHERE ip=? AND so=? AND nav=? AND usuario=? AND token=?");
        $consult->bind_param("sssis", $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["user"], $_SESSION["token"]);
        $consult->execute();
        $resDisp = $consult->get_result();
        // Se revisa que exista un registro con ese dispositivo
        if ($resDisp->num_rows > 0){
            // Existe
            // Revisar si se encuentra validado
            while ($row = $resDisp->fetch_assoc()){
                $validAux = $row["valid"];
                if ($validAux == "Si"){
                    // Se encuentra validado
                    $estado = 1;
                }else if($validAux == "No"){
                    // No se encuentra validado
                    $estado = 2;
                }
            }
        }else{
            // No Existe
            $estado = 3;
        }
        return $estado;
    }catch(Exception $ex){
        return 0;
    }
}
#endregion

#region Agregar sesión
function setSesion(){
    global $conn;
    try{
        $consult = $conn->prepare("INSERT INTO set_sesiones(usuario, sesion, fecha, token) 
        VALUES (?, 'No', ?, ?)");
        $consult->bind_param("iss", $_SESSION["user"], $_SESSION["fecha"], $_SESSION["token"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Actualizar token
function actualizarToken(){
    global $conn;
    try{
        $consult = $conn->prepare("UPDATE set_dispositivos 
        SET token=? 
        WHERE usuario=?");
        $consult->bind_param("si", $_SESSION["token"], $_SESSION["user"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Registrar dispositivo
function registrarDispositivo() {
    global $conn;
    try {
        $consult = $conn->prepare("INSERT INTO set_dispositivos (ip, so, nav, usuario, pin, valid, sesion, fecha, actual, token) VALUES (?, ?, ?, ?, ?, 'No', 'No', ?, 'No', ?)");
        $consult->bind_param("sssisss", $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["user"], $_SESSION["pin"], $_SESSION["fecha"], $_SESSION["token"]);
        $consult->execute();
    } catch (Exception $ex) {
        // Manejar excepción
    }
}
#endregion

#region Actualizar dispositivo 
function actualizarDispositivo(){
    global $conn;
    try{
        $consult = $conn->prepare("UPDATE set_dispositivos
        SET sesion='No', actual='No', pin=?
        WHERE usuario=? AND ip=? AND so=? AND nav=?");
        $consult->bind_param("sisss", $_SESSION["pin"] , $_SESSION["user"], $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Desactivar dispositivos
function desactivarDispositivos(){
    global $conn;
    try{
        $consult = $conn->prepare("UPDATE set_dispositivos
        SET sesion='No', actual='No'
        WHERE usuario=? OR ip!=? OR so!=? OR nav!=? OR token!=?");
        $consult->bind_param("issss", $_SESSION["user"], $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["token"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Validar sesion
function validarSesion(){
    global $conn;
    try{
        $queryValDisp = "UPDATE set_sesiones 
        SET sesion='Si'
        WHERE usuario=? 
        AND fecha=? 
        AND token=?";
        $consult = $conn->prepare($queryValDisp);
        $consult->bind_param("iss", $_SESSION["user"], $_SESSION["fecha"], $_SESSION["token"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Validar sesión dispositivo
function validarSesionDisp() {
    global $conn;
    try{
        // Se actualiza el campo sesion
        $consult = $conn->prepare("UPDATE set_dispositivos
        SET sesion='Si', actual='Si'
        WHERE usuario=? AND ip=? AND so=? AND token=? AND nav=?");
        $consult->bind_param("issss", $_SESSION["user"], $_SESSION["ip"], $_SESSION["so"], $_SESSION["token"], $_SESSION["nav"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Generar Pin
function generarPin() {
    $pin = rand(1000, 9999);
    return $pin;
}
#endregion

#region Validar dominio
function domValid() {
    $host = $_SERVER['HTTP_HOST'];
    return $host === 'localhost' || $host === '127.0.0.1';
}
#endregion

?>
