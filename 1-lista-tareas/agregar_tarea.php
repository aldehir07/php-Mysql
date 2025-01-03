<?php
    //conectar a la base de datos

    $conn = new mysqli('localhost', 'root', '', 'lista_tareas_db');
    if($conn->connect_error){
        die("Conexion FALLIDA: " .$conn->connect_error);
    }

    //Obtener la tarea del formulario
    $tarea = $_POST['tarea'];

    //Insertar la tarea en la base de datos
    $sql = "INSERT INTO tareas (tarea) VALUES ('$tarea')";

    if($conn->query($sql) === TRUE){
        header("Location: index.php"); //Redirigir al index despues de agregar la tarea
    }else{
        echo "ERROR: " .$sql. "<br>" . $conn->error;
    }

    $conn->close();
?>