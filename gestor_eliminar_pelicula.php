<?php
    session_start();
    $titulo = $_POST['titulo'];

    // Validar los datos
    if (empty($titulo)) {
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

        $sql = "DELETE FROM peliculas WHERE titulo = '$titulo';";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Mostrar un mensaje de éxito
            header( "Location: datos_pelicula_eliminada.php" ); 
            echo "¡La pélicula ha sido eliminada correctamente!";
            echo "Nombre de la película: " . $titulo . "<br>";
        } else {
            echo "Error al actualizar los datos" . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    
    }
?>