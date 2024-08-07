<?php

include 'mysqlConn.php';
session_start();

$tokenDisp= filter_input(INPUT_POST,'tokenDisp', FILTER_SANITIZE_STRING);

$alerta = "Error";

try{
    $queryDisp = "SELECT * FROM set_dispositivos WHERE token = ?";
    $consult = $conn->prepare($queryDisp);
    $consult->bind_param("s", $tokenDisp);
    $consult->execute();

    $result = $consult->get_result();
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            if ($row["token"] != $_SESSION["token"] && $row["usuario"] == $_SESSION["user"]){
                if ($row["actual"] == "No"){
                    eliminar($tokenDisp);
                }
            }
        }
    }
}catch(Exception $ex){
    // err
}

header('Location: principal.php');

// Función -------------------------------------------------

#region Eliminar dispositivo
function eliminar($token){
    global $conn;
    try{
        $queryElim = "DELETE FROM set_dispositivos WHERE token=?";
        $con = $conn->prepare($queryElim);
        $con->bind_param("s", $token);
        $con->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

?>