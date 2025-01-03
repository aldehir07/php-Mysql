<?php
    $conn = new mysqli('localhost', 'root', '', 'lista_tareas_db');
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Obtener el ID de la tarea a eliminar y preparar la consulta
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM tareas WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Cerrar la conexión y la declaración preparada
    $stmt->close();
    $conn->close();
?>