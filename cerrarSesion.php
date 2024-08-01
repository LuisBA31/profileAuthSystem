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
    $queryValSes = "UPDATE set_dispositivos SET sesion='No', actual='No' WHERE token=" . $_SESSION["token"] . ";";
    $resValSes = $conn->query($queryValSes);
}
#endregion

?>