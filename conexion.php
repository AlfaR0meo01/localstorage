<?php
$servername = "";
$username = "";
$password = "";
$db="";

$mysqli = new mysqli($servername, $username, $password, $db);  
if (mysqli_connect_errno()) {    
    printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
    exit(); 
}  

?> 
