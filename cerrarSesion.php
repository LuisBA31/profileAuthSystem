<?php

include 'mysqlConn.php';
session_start();

// Se termina la sesión
cerrarSesion();
session_destroy();
$conn->close();
header('Location: index.php');

// Funciones ------------------

#region Cerrar sesión
function cerrarSesion(){
    global $conn;
    try{
        $queryValSes = "UPDATE set_dispositivos SET sesion='No', actual='No' WHERE token = ?";
        $consult = $conn->prepare($queryValSes);
        $consult->bind_param("s", $_SESSION["token"]);
        $consult->execute();
    } catch(Exception $ex){
        // Err
    }
}

#endregion

?>