<?php

include 'mysqlConn.php';
session_start();

if (tieneImagen()){
    $id = intval($_SESSION["user"]);
    $query = "SELECT nombre, tipo, imagen FROM set_imagenes WHERE id = ?";
    $res = $conn->prepare($query);
    $res->bind_param("i", $id);
    $res->execute();
    $res->store_result();

    // Verificar si se encontró la imagen
    if ($res->num_rows > 0) {
        $res->bind_result($nombre, $tipo, $imagen);
        $res->fetch();

        // Configurar los encabezados
        header("Content-Type:" . $tipo);
        echo $imagen;
    } else {
        // No se encontró la imagen
    }
}

// Funciones ------------------------------------

#region revisar imagen usuario
function tieneImagen(){
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

?>