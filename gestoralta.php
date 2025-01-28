<?php
session_start();

// Obtener los datos enviados desde el formulario
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
if (empty($username) || empty($password) || empty($confirm_password) || empty($email) || empty($nombre) || empty($apellido) || empty($phone) || empty($birthdate) || empty($ciudad) || empty($sexo)) {
    $_SESSION['error_message'] = "Por favor, completa todos los campos.";
    header("Location: altausuarios.php");
    exit();
} elseif ($password != $confirm_password) {
    $_SESSION['error_message'] = "Error: contraseñas diferentes";
    header("Location: contraseña_diferente.php");
    exit();
} else {
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

    // Verificar si el usuario ya existe
    $selectQuery = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Ese nombre de usuario ya existe.";
        header("Location: dado_no_alta.php");
        exit();
    } else {
        // Insertar el usuario en la base de datos
        $rol = "usuario";
        $insertQuery = "INSERT INTO usuarios (nombre, apellido, username, email, contrasenia, confirm_password, phone, birthdate, ciudad, sexo, rol) VALUES (
        '$nombre', '$apellido', '$username', '$email', '$password', '$confirm_password', '$phone', '$birthdate', '$ciudad', '$sexo', '$rol')";

        if ($conn->query($insertQuery) === TRUE) {
            header("Location: dado_de_alta.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error al agregar el usuario: " . $conn->error;
            header("Location: altausuarios.php");
            exit();
        }
    }


    // Cerrar la conexión a la base de datos
    $conn->close();
}

