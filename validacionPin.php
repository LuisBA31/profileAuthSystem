<?php

include 'mysqlConn.php';
session_start();

$pin = filter_input(INPUT_POST,'pin', FILTER_SANITIZE_NUMBER_INT);

// Verificación de dominio y petición
if (domValid() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (validarPin()){
        if (confirmarPin()){
            // Pin válido
            // Se valida el PIn en el dispositivo
            validarPinValBdd();
            // Se establece como la sesión actual
            setActual();
            setSesion();
            // Reedireciona a la página principal
            header ('Location: principal.php');
        }else{
            // Pin no válido
            header ('Location: index.php');
        }
    }else{
    }
}else{
    header('Location: index.php');
}

// Funciones ------------------------------------------------------------------

#region Validar pin
function validarPin(){
    global $pin;
    if (is_numeric($pin)){
        if (strlen($pin) == 4){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
#endregion

#region Confirmar pin
function confirmarPin(){
    global $pin, $conn;
    $queryPin = "SELECT * FROM set_dispositivos 
    WHERE usuario=?
    AND token=?";
    $consult = $conn->prepare($queryPin);
    $consult->bind_param("is", $_SESSION["user"], $_SESSION["token"]);
    $consult->execute();
    $result = $consult->get_result();
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $pinAux = $row["pin"];
            if ($pin == $pinAux){
                // los pines coinciden
                return true;
            }else{
                // Los pines no coinciden
                return false;
            }
        }
    }
    return false;
}
#endregion

#region validarPin
function validarPinValBdd(){
    global $pin, $conn;
    try{
        // Cambiar en dispositivo
        $queryValDisp = "UPDATE set_dispositivos 
        SET valid='Si' 
        WHERE pin=? 
        AND ip=? 
        AND so=? 
        AND nav=? 
        AND usuario=?
        AND token=?";
        $consult = $conn->prepare($queryValDisp);
        $consult->bind_param("isssis", $pin, $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["user"], $_SESSION["token"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Sesion actual
function setActual(){
    global $conn;
    try{
        $queryValDisp = "UPDATE set_dispositivos 
        SET actual='Si', sesion='Si'
        WHERE ip=? 
        AND so=? 
        AND nav=? 
        AND usuario=?
        AND token=?";
        $consult = $conn->prepare($queryValDisp);
        $consult->bind_param("sssis", $_SESSION["ip"], $_SESSION["so"], $_SESSION["nav"], $_SESSION["user"], $_SESSION["token"]);
        $consult->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

#region Sesion actual
function setSesion(){
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

#region Validar dominio
function domValid() {
    $host = $_SERVER['HTTP_HOST'];
    return $host === 'localhost' || $host === '127.0.0.1';
}
#endregion

?>