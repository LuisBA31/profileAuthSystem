<?php

include 'mysqlConn.php';
session_start();

// Validando que los PINS coincidan

// Validar
if (is_numeric($pin)){
    if (strlen($pin) > 0 && strlen($pin) <= 4){
        if (confirmarPin()){
            // Pin válido
            // Se eliminan las demás sesiones para guardar solo 1
            eliminarSesiones();
            // Se registra de nuevo la sesión
            registrarSesion();
            // Se cambia la variable de validación del PIN
            validarPinBdd();
            // Se cambia la variable de sesión
            $_SESSION["valid"] = "Si";
            // Se establece como la sesión actual
            setActual();
            // Reedireciona a la página principal
            header ('Location: principal.php');
        }else{
            // Pin no válido
            header ('Location: index.php');
        }
    }
}else{
    // El pin no es válido
    header ('Location: index.php');
}

// Funciones ------------------------------------------------------------------

#region Confirmar pin
function confirmarPin(){
    global $pin, $conn;
    $queryPin = "SELECT * FROM set_dispositivos 
    WHERE ip='" . $_SESSION["ip"] . "' 
    AND so='" . $_SESSION["so"] . "' 
    AND nav='" . $_SESSION["nav"] . "' 
    AND user=" . $_SESSION["user"] . " 
    AND token=" . $_SESSION["token"] . ";";
    $resPin = $conn->query($queryPin);
    if ($resPin->num_rows > 0){
        while ($row = $resPin->fetch_assoc()){
            $pinAux = $row["pin"];
            if ($pin == $pinAux){
                // los pines coinciden
                return true;
            }else{
                // Los pines no coinciden
                // Regresa al inicio de sesión
                return false;
            }
        }
    }
}
#endregion

#region validarPin
function validarPinBdd(){
    global $pin, $conn;
    try{
        // Cambiar en dispositivo
        $queryValDisp = "UPDATE set_dispositivos 
        SET valid='Si' 
        WHERE pin=$pin 
        AND ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . "
        AND token=" . $_SESSION["token"] . ";";
        $resPin = $conn->query($queryValDisp);
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Sesion actual
function setActual(){
    global $pin, $conn;
    try{
        // Cambiar en dispositivo
        $queryValDisp = "UPDATE set_dispositivos 
        SET actual='Si' 
        WHERE pin=$pin 
        AND ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . "
        AND token=" . $_SESSION["token"] . ";";
        $resPin = $conn->query($queryValDisp);
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Validacion de sesión
function setSesion(){
    global $pin, $conn;
    try{
        // Cambiar en dispositivo
        $queryValDisp = "UPDATE set_dispositivos 
        SET sesion='Si' 
        WHERE pin=$pin 
        AND ip='" . $_SESSION["ip"] . "' 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND user=" . $_SESSION["user"] . "
        AND token=" . $_SESSION["token"] . ";";
        $resPin = $conn->query($queryValDisp);
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

#region Eliminar sesiones
function eliminarSesiones() {
    global $conn;
    try {
        $queryElim = "DELETE FROM set_dispositivos 
        WHERE user=" . $_SESSION["user"] . " 
        AND so='" . $_SESSION["so"] . "' 
        AND nav='" . $_SESSION["nav"] . "' 
        AND ip='" . $_SESSION["ip"] . "' 
        AND token=" . $_SESSION["token"] . ";";
        $elim = $conn->query($queryElim);
    } catch (Exception $ex) {
        // Manejar excepción
    }
}
#endregion

?>