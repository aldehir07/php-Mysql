<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
</head>
<body>
    <h2>Lista de Tareas</h2>
    <form action="agregar_tarea.php" method="post">
        <input type="text" name="tarea" placeholder="Escribe una nueva tarea" required>
        <input type="submit" value="Agregar">
    </form>

    <ul>
        <?php
            // Conectar a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'lista_tareas_db');
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Obtener todas las tareas
            $sql = "SELECT * FROM tareas";
            $result = $conn->query($sql);

            // Mostrar las tareas en la lista
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row['tarea']) . " 
                        <a href='eliminar_tarea.php?id=" . $row['id'] . "'>Eliminar</a></li>";
                }
            } else {
                echo "<li>No hay tareas pendientes.</li>";
            }

            $conn->close();
        ?>
    </ul>
</body>
</html>