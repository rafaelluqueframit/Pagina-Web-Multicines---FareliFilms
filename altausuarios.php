<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="altausuarios.css">
    </head>
    
<body>

    <header>
        <a href="index.php"><img id="logoCine" src="imagenes/FareliFilms.jpg" alt="Logo del cine" ></a>
        <h1 id="tituloPrincipal">FARELI FILMS</h1>
        <?php
        session_start();
        // Verificar si el usuario ya ha iniciado sesión
        if (isset($_SESSION['username'])) {
            // Mostrar mensaje de bienvenida y enlace para desloguearse
            $message = "¡Bienvenido, " . $_SESSION['username'] . "! Rol: " . $_SESSION['rol'] . ".";
            echo '<p class="mensajeBienvenida">' . $message . ' <a id="desconectar" href="desloguear.php">Desloguearse</a></p>';

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Conexión a la base de datos
            $servername = "localhost";
            $username_db = "pwrafaelluque";
            $password_db = "--rafael--";
            $database = "dbrafaelluque_pw2223";

            $conexion = new mysqli($servername, $username_db, $password_db, $database);

            // Verificar si hay un error de conexión
            if ($conexion->connect_error) {
                die('Error de conexión a la base de datos: '.$conexion->connect_error);
            }

            // Obtener los datos ingresados por el usuario
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Consulta para verificar las credenciales del usuario
            $consulta = "SELECT * FROM usuarios WHERE username = '$username' AND contrasenia = '$password'";
            $resultado = $conexion->query($consulta);
            $consulta2 = "SELECT rol FROM usuarios WHERE username = '$username' AND contrasenia = '$password'";
            $rol = $conexion->query($consulta2);

            if ($resultado->num_rows === 1) { // Verificar si se encontraron resultados
                // Usuario autenticado correctamente
                $_SESSION['username'] = $username;
                $_SESSION['rol'] = $rol->fetch_assoc()['rol'];
                $message = "¡Bienvenido, " . $username . "! Rol: " . $_SESSION['rol'] . ".";
                echo '<p class="mensajeBienvenida">' . $message . ' <a id="desconectar" href="desloguear.php">Desloguearse</a></p>';

            } else {
                // Usuario no válido
                $message = "Usuario o contraseña incorrectos. Inténtalo nuevamente.";
                echo "<p>$message</p>";

                // Mostrar formulario de inicio de sesión
                ?>
                <form id="formHead" method="POST" action="index.php">
                    <label id="form1" for="username">Usuario:</label><br>
                    <input type="text" id="username" name="username" value="" required /><br>
                    <label id="form2" for="password">Contraseña:</label><br>
                    <input type="password" id="password" name="password" value="" required />
                    <br>
                    <input id="form3" type="submit" id="boton1" value="Enviar" /><br>
                    <a id="altaUsuarios" href="altausuarios.php">Registro de usuarios</a>
                </form>
                <?php
            }

            $conexion->close();
        } else {
            // Mostrar formulario de inicio de sesión
            ?>
            <form id="formHead" method="POST" action="index.php">
                <label id="form1" for="username">Usuario:</label><br>
                <input type="text" id="username" name="username" value="" required /><br>
                <label id="form2" for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" value="" required />
                <br>
                <input id="form3" type="submit" id="boton1" value="Enviar" /><br>
                <a id="altaUsuarios" href="altausuarios.php">Registro de usuarios</a>
            </form>
            <?php
            // Mostrar mensaje de error si existe
            if (isset($message)) {
                echo '<p class="mensajeBienvenida">' . $message . '</p>';
            }
        }
        ?>

        <nav id="navegador">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="estrenos.php">Estrenos</a></li>
                <li><a href="cartelera.php">Cartelera</a></li>
                <li><a href="horarios.php">Horarios</a></li>
                <li><a href="tarifas.php">Tarifas</a></li>
                <li><a href="informacion.php">Informacion</a></li>
            </ul>
        </nav>

    </header>

    <main>

        <section id="sectionAlta">
            <article id="titAlta"><h2 class="titulosBody">Formulario de alta de usuarios</h2></article>
            <form id="formAlta" action="gestoralta.php" method="POST">
                <label class="labelAlta" for="nombre">Nombre (*):</label>
                <input class="inputAlta" type="text" pattern="^[^']*?$" id="nombre" name="nombre" required>

                <label class="labelAlta" for="apellido">Apellidos (*):</label>
                <input class="inputAlta" type="text" pattern="^[^']*?$" id="apellido" name="apellido" required>

                <label class="labelAlta" for="username">Nombre de Usuario (*):</label>
                <input class="inputAlta" type="text" pattern="^[^']*?$" id="NombreDeUsuario" name="username" required>

                <label class="labelAlta" for="email">Correo electrónico (*):</label>
                <input class="inputAlta" type="email" pattern="^[^']*?$" id="email" name="email" required>

                <label class="labelAlta" for="password">Contraseña (*):</label>
                <input class="inputAlta" type="password" pattern="^[^']*?$" id="password" name="password" required> 

                <label class="labelAlta" for="confirm_password">Confirmar contraseña (*):</label>
                <input class="inputAlta" type="password" pattern="^[^']*?$" id="confirm-password" name="confirm_password" required>

                <label class="labelAlta" for="phone">Número de teléfono (*):</label>
                <input class="inputAlta" type="tel" id="phone" name="phone" pattern="[0-9]{9}" required>

                <label class="labelAlta" for="birthdate">Fecha de nacimiento:</label>
                <input class="inputAlta" type="date" id="birthdate" name="birthdate" required>
                
                <label class="labelAlta" for="ciudad">Ciudad donde usted habita </label>
                <input class="inputAlta" type="text" pattern="^[^']*?$" id="ciudad" name="ciudad" required>

                <label class="labelAlta" for="sexo">Sexo:</label>
                <section class="sexo-container">
                    <input type="radio" id="hombre" name="sexo" value="Masculino" required>
                    <label for="Masculino" class="sexo-label hombre-label">Masculino</label>

                    <input type="radio" id="mujer" name="sexo" value="Femenino" required>
                    <label for="Femenino" class="sexo-label mujer-label">Femenino</label>

                    <input type="radio" id="otro" name="sexo" value="Otro" required>
                    <label for="Otro" class="sexo-label otro-label">Otro</label>
                </section>

                <button type="submit">Enviar</button>
                <input type = "reset" value = "Reiniciar formulario" />
                <h4 class="mensaje">Gracias por registrarte.</h4>
            </form>

        </section>

        <script>
            // Obtener referencia al formulario
            var form = document.getElementById('formAlta');

            // Agregar un evento de escucha al envío del formulario
            form.addEventListener('submit', function(event) {
            // Obtener todos los campos de entrada del formulario
            var inputs = form.getElementsByTagName('input');

            // Bandera para indicar si hay campos vacíos
            var camposVacios = false;

            // Verificar cada campo de entrada
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].value.trim() === '') {
                camposVacios = true;
                break; // Si hay un campo vacío, se detiene el bucle
                }
            }

            // Si hay campos vacíos, se cancela el envío del formulario
            if (camposVacios) {
                event.preventDefault();
                alert('No se pueden enviar campos vacíos.');
            }
            });
        </script>

    </main>
    
    <footer>
        <section id="foot">
            <h3 id="foot1"><a href="contacto.php" >Contacto</a></h3>
            <h3 id="foot2"><a href="como_se_hizo.pdf">Como se hizo</a></h3>
            <h3 id="foot3">© 2023 Faraeli Films. Todos los derechos reservados.</h3>
            <h3 id="foot4">Síguenos en nuestras redes sociales</h3>
            <img id="foot5" src = "imagenes/instagram.jpg" alt = "Instagram" width="27%"/>
            <img id="foot6" src = "imagenes/twiter.jpg" alt = "Twiter" width="27%"/>
            <img id="foot7" src = "imagenes/facebook.jpg" alt = "Facebook" width="27%"/>
        </section>
    </footer>

</body>

</html>