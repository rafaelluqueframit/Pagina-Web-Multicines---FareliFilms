<?php
    session_start();
    $titulo = $_POST['titulo'];
    $director = $_POST['director'];
    $fecha = $_POST['fecha'];
    $interpretes = $_POST['interpretes'];
    $tematica = $_POST['tematica'];
    $tiempo = $_POST['tiempo'];
    $valoracionMedia = $_POST['valoracionMedia'];
    $sinopsis = $_POST['sinopsis'];
    $categoria = $_POST['categoria'];
    $selectedImages = $_POST["selectedImages"];
    $selectedImagesArray = explode(",", $selectedImages);

    // Guardar las rutas de las imágenes en variables distintas
    $direccionFoto1 = isset($selectedImagesArray[0]) ? $selectedImagesArray[0] : "";
    $direccionFoto2 = isset($selectedImagesArray[1]) ? $selectedImagesArray[1] : "";
    $direccionFoto3 = isset($selectedImagesArray[2]) ? $selectedImagesArray[2] : "";
    $direccionFoto4 = isset($selectedImagesArray[3]) ? $selectedImagesArray[3] : "";
    

    // Validar los datos
    if (empty($titulo) || empty($director) || empty($fecha) || empty($interpretes) || empty($tematica) || empty($tiempo) || empty($valoracionMedia) || empty($sinopsis) || empty($categoria) || empty($direccionFoto1) || empty($direccionFoto2) || empty($direccionFoto3) || empty($direccionFoto4)) {
        $_SESSION['error_message'] = "Por favor, completa todos los campos.";
        header("Location: añadirPeli.php");
        exit();
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

        // Verificar si la peli ya existe
        $selectQuery = "SELECT * FROM peliculas WHERE titulo = '$titulo'";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            $_SESSION['error_message'] = "Este nombre de película ya existe.";
            header("Location: peli_no_añadida.php");
            exit();
        } else{
            // Preparar la consulta para insertar los datos en la base de datos
            $sql = "INSERT INTO peliculas (titulo, director, fecha, interpretes, tematica, tiempo, valoracionMedia, sinopsis, categoria, direccionFoto1, direccionFoto2, direccionFoto3, direccionFoto4) VALUES('$titulo', '$director', '$fecha', '$interpretes', '$tematica', '$tiempo', '$valoracionMedia', '$sinopsis', '$categoria', '$direccionFoto1', '$direccionFoto2', '$direccionFoto3', '$direccionFoto4');";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                // Mostrar un mensaje de éxito 
                echo "¡La película ha sido añadida correctamente!";
                echo "Nombre de la película: " . $titulo . "<br>";
                $_SESSION['success_message'] = "¡La película ha sido añadida correctamente!";
                header( "Location: pelicula_añadida.php" );
                exit();
            } else {
                $_SESSION['error_message'] = "Error al actualizar los datos" . $conn->error;
                header("Location: peli_no_añadida.php");
                exit();
            }
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
?>