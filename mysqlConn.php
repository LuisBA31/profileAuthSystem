<?php 
// valores bdd
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Conexión a bdd
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>