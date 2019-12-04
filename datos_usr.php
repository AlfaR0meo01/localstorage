<?php
    include_once('conexion.php');
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];

    $sql = "INSERT INTO localstorage(nombre,apellidos,correo,edad) values ('$nombre','$apellidos','$correo',$edad)";
    if ($mysqli->query($sql) != false) 
    {
        $json = '{"nombre":"'.$nombre.'","apellidos":"'.$apellidos.'","correo":"'.$correo.'",edad:"'.$edad.'"}';
         echo $json;
    }else{
        echo 0;
    }
?>
