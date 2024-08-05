<?php

include 'mysqlConn.php';
session_start();

$idDisp= filter_input(INPUT_POST,'idDisp', FILTER_SANITIZE_NUMBER_INT);

$alerta = "Error";

try{
    $queryDisp = "SELECT * FROM set_dispositivos WHERE idDisp = ?";
    $consult = $conn->prepare($queryDisp);
    $consult->bind_param("i", $idDisp);
    $consult->execute();

    $result = $consult->get_result();
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            if ($row["token"] != $_SESSION["token"]){
                if ($row["actual"] == "No"){
                    eliminar($idDisp);
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
function eliminar($id){
    global $conn;
    try{
        $queryElim = "DELETE FROM set_dispositivos WHERE idDisp=?";
        $con = $conn->prepare($queryElim);
        $con->bind_param("i", $id);
        $con->execute();
    }catch(Exception $ex){
        // err
    }
}
#endregion

?>