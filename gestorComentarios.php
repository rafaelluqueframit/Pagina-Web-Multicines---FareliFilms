<?php
    session_start();
    $titulo = $_SESSION['titulo'];
    $username = $_SESSION["username"];
    $comentario = $_POST['comentario'];
    $valoracionMedia = $_POST['valoracionMedia'];
    
    // Validar los datos
    if (empty($titulo) || empty($username) || empty($comentario) || empty($valoracionMedia)) {
        echo "Por favor, completa todos los campos.";
    }else{

        // Registrar los datos en una base de datos
        $servername = "localhost";
        $username_db = "pwrafaelluque";
        $password_db = "--rafael--";
        $database = "dbrafaelluque_pw2223";

        $conn = new mysqli($servername, $username_db, $password_db, $database);

        // Verificar si hay errores de conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Preparar la consulta para insertar los datos en la base de datos
        $sql = "INSERT INTO comentarios (username, comentario, valoracionMedia, titulo) VALUES('$username', '$comentario', '$valoracionMedia', '$titulo');";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Mostrar un mensaje de éxito
            header('Location: peli.php?titulo=' . $titulo);
            echo "¡El comentario ha sido añadida correctamente!";
        } else {
            echo "Error al añadir el comentario" . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();   
    }
?>