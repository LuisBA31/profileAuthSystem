<?php
include ('sesion.php');
// Se verifica que las peticiones se realizen desde el dominio y mediante POST
if (domValid() || $_SERVER['REQUEST_METHOD'] === 'POST') {
    include ('loginForm.php');
}else{
    header('index.php');
}
?>