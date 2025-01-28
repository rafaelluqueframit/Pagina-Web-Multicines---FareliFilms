<?php
    session_start();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $ciudad = $_POST['ciudad'];
    $sexo = $_POST['sexo'];

    // Validar los datos
    if (empty($password) || empty($confirm_password) || empty($username) || empty($email) || empty($nombre) || empty($apellido) || empty($phone) || empty($birthdate) || empty($ciudad) || empty($sexo)) {
        echo "Por favor, completa todos los campos.";
    }elseif($password != $confirm_password){
        echo "Error: contraseñas diferentes";
    }
    else{
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

        $userAntiguo = $_SESSION['username'];
        
        if($userAntiguo === $username){
            // Preparar la consulta para insertar los datos en la base de datos
            $rol = "usuario";
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', username = '$username', email = '$email', contrasenia = '$password', confirm_password = '$confirm_password', phone = '$phone', birthdate = '$birthdate', ciudad = '$ciudad', sexo = '$sexo' WHERE username = '$username';";

            // Ejecutar la consulta
            if ($conn->query($sql) === TRUE) {
                // Mostrar un mensaje de éxito
                header( "Location: datos_cambiados.php" ); 
                echo "¡Los datos han sido actualizados correctamente!";
                echo "Nombre de usuario: " . $username . "<br>";
            } else {
                echo "Error al actualizar los datos" . $conn->error;
            }
        }else{
            // Verificar si el username ya existe
            $selectQuery = "SELECT * FROM usuarios WHERE username = '$username';";
            $result = $conn->query($selectQuery);

            if ($result->num_rows > 0) {
                $_SESSION['error_message'] = "Este username ya existe.";
                header("Location: user_no_actualizado.php");
                exit();
            } else{

                // Preparar la consulta para insertar los datos en la base de datos
                $rol = "usuario";
                $sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', username = '$username', email = '$email', contrasenia = '$password', confirm_password = '$confirm_password', phone = '$phone', birthdate = '$birthdate', ciudad = '$ciudad', sexo = '$sexo' WHERE username = '$userAntiguo';";

                // Ejecutar la consulta
                if ($conn->query($sql) === TRUE) {
                    // Mostrar un mensaje de éxito
                    header( "Location: datos_cambiados.php" ); 
                    echo "¡Tus datos han sido actualizados correctamente!";
                    echo "Nombre de usuario: " . $username . "<br>";
                    echo "Correo electrónico: " . $email . "<br>";
                } else {
                    echo "Error al actualizar los datos" . $conn->error;
                }
            }
        }     
        $conn->close();
    }
?>