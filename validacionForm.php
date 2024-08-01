stmt<?php

include 'mysqlConn.php';
session_start();

$_SESSION['user'] = $_POST['idUsr'];
$_SESSION['passwd'] = $_POST['passwd'];

// Valores del usuario
$id = $_POST['idUsr'];
$passw = $_POST['passwd'];
$valid = false;

// Validar usuario y contraseña
if (is_numeric($id)) {
    if (strlen($passw) > 0 && strlen($passw) <= 4) {
        // Ambos campos validados
        // Se procede a validar en la bdd
        validControl();
    } else {
        // Passw incorrecta
        header('Location: index.php');
    }
} else {
    // id incorrecto
    header('Location: index.php');
}

// Funciones ------------------------------------------------------

#region Control
function validControl() {
    global $conn;
    if (logIn()) {
        // Se pudo iniciar sesión
        // Actualizar token en las existentes
        actualizarToken();
        // Se eliminan las sesiones no validadas de dias pasados
        eliminarSesiones();
        // Se valida el estado del dispositivo
        switch (revisarDisp()){
            case 1:
                // El dispositivo existe y está validado 
                // Se actualizan las sesiones
                actualizarSesion();
                // Se actualizan los campos para asginar las sesión activa
                validarSesion();
                // Se redirecciona a la página principal
                $_SESSION["valid"] = "Si";
                header('Location: principal.php');
                break;
            case 2:
                // El dispositivo existe y no está validado
                // Se revisa que no haya más de 4 intentos
                if (revisarSesion()){
                    // Puede seguir intentando
                    // Se actualizan las sesiones
                    actualizarSesion();
                    // Se crea un nuevo pin
                    $_SESSION["pin"] = obtenerPin();
                    // Se agrega una sesión
                    registrarSesion();
                    // Se redirecciona al Pin form
                    header('Location: pinForm.php');
                }else{
                    // Ya no puede seguir iniciando
                    header('Location: index.php');
                }
                break;
            case 3:
                // El dispositivo no existe
                // Se genera un PIN para el dispositivo
                $_SESSION["pin"] = generarPin();
                // Se agrega una sesión
                registrarSesion();
                // Se registra la sesión con el PIN
                // Se redirecciona al form de PIN
                header('Location: pinForm.php');
                break;
            default:
                // Error
                header('Location: index.php');
                break;
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
        $query = "SELECT pw FROM set_usuarios WHERE id=" . $id . ";";
        $res = $conn->query($query);

        if ($res->num_rows > 0) {
            // validar constraseña
            while ($row = $res->fetch_assoc()) {
                $passwAux = $row["pw"];
                if ($passw == $passwAux) {
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

#region Revisar dispositivos
function revisarDisp() {
    global $conn;
    try{
        $estado = 0;
        // Consulta del dispositivo
        /*
        $queryDisp = "SELECT * FROM set_dispositivos 
        WHERE ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . " 
        AND fecha='" . $_SESSION["fecha"] . "';";
        */
        $queryDisp = "SELECT * FROM set_dispositivos 
        WHERE ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . ";";
        $resDisp = $conn->query($queryDisp);
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

#region Actualizar token
function actualizarToken(){
    global $conn;
    try{
        $queryTokenDisp = "UPDATE set_dispositivos 
        SET token='" . $_SESSION["token"] . "' 
        WHERE user=" . $_SESSION["user"] . "
        AND ip='" . $_SESSION["ip"] . "'
        AND so='" . $_SESSION["so"] . "'
        AND nav='" . $_SESSION["nav"] . "';";
        $res = $conn->query($queryTokenDisp);
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Registrar sesión
function registrarSesion() {
    global $conn;
    try {
        $queryRegistrarDisp = "INSERT INTO set_dispositivos (ip, so, nav, user, pin, valid, sesion, fecha, actual, token) VALUES (
            '" . $_SESSION["ip"] . "',
            '" . $_SESSION["so"] . "',
            '" . $_SESSION["nav"] . "',
            " . $_SESSION["user"] . ",
            " . $_SESSION["pin"] . ",
            'No',
            'No',
            '" . $_SESSION["fecha"] . "',
            'No',
            " . $_SESSION["token"] . "
        );";
        $resRegDisp = $conn->query($queryRegistrarDisp);
    } catch (Exception $ex) {
        // Manejar excepción
    }
}
#endregion

#region Actualizar sesión 
function actualizarSesion(){
    global $conn;
    $queryAct = "UPDATE set_dispositivos
        SET sesion='No', actual='No'
        WHERE user=" . $_SESSION["user"] . "
        AND ip='" . $_SESSION["ip"] . "'
        AND so='" . $_SESSION["so"] . "'
        AND nav='" . $_SESSION["nav"] . "';";
    $resp = $conn->query($queryAct);
}
#endregion

#region Validar sesión
function validarSesion() {
    global $conn;
    try{
        // Se actualiza el campo sesion
        $queryValid = "UPDATE set_dispositivos
        SET sesion='Si'
        WHERE user=" . $_SESSION["user"] . "
        AND ip='" . $_SESSION["ip"] . "'
        AND so='" . $_SESSION["so"] . "'
        AND token='" . $_SESSION["token"] . "'
        AND nav='" . $_SESSION["nav"] . "';";
        $resp = $conn->query($queryValid);
        // Se actualiza el campo de actual
        $queryAct = "UPDATE set_dispositivos
        SET actual='Si'
        WHERE user=" . $_SESSION["user"] . "
        AND ip='" . $_SESSION["ip"] . "'
        AND so='" . $_SESSION["so"] . "'
        AND token='" . $_SESSION["token"] . "'
        AND nav='" . $_SESSION["nav"] . "';";
        $resp2 = $conn->query($queryAct);
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Revisar sesión
function revisarSesion() {
    global $conn;
    $queryDisp = "SELECT * FROM set_dispositivos WHERE pin=" . $_SESSION["pin"] . " AND token=" . $_SESSION["token"] . ";";
    $resDisp = $conn->query($queryDisp);

    // Se revisa si hay más de 4 sesiones
    if ($resDisp->num_rows < 4) {
        // Hay menos de 4, se registra
        return true;
    }else{
        // Hay menos de 4, se registra
        return false;
    }
}
#endregion

#region Generar Pin
function generarPin() {
    $pin = rand(1000, 9999);
    return $pin;
}
#endregion

#region Obtener Pin
function obtenerPin() {
    global $conn;
    try{
        $queryPin = "SELECT pin 
        FROM set_dispositivos 
        WHERE user=" . $_SESSION["user"] . "
        AND ip='" . $_SESSION["ip"] . "'
        AND so='" . $_SESSION["so"] . "'
        AND nav='" . $_SESSION["nav"] . "'
        AND fecha='" . $_SESSION["fecha"] . "';";
        $res = $conn->query($queryPin);
        if ($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $pin = $row["pin"];
            }
        }
        return $pin;
    }catch(Exception $ex){
        // err
        return "0";
    }
}
#endregion

#region Eliminar sesiones
function eliminarSesiones() {
    global $conn;
    try {
        $queryElim = "DELETE set_dispositivos 
        WHERE user='" . $_SESSION["user"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND ip='" . $_SESSION["ip"] . "' 
        AND token=" . $_SESSION["token"] . "
        AND fecha!=" . $_SESSION["fecha"] . "'
        AND valid='No';";
        $elim = $conn->query($queryElim);
    } catch (Exception $ex) {
        // Manejar excepción
    }
}
#endregion

?>