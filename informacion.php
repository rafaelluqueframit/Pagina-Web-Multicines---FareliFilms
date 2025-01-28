<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="informacion.css">
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
        <section id="info">
            <article class="tituloSeccion">
                <h2 class="titulosBody">INFORMACION</h2>
            </article>

            <img id="gif" src="imagenes/gif1.gif" alt="gif_cine" width="50%"/>

            <article id="lista2">
                <p>Horario de apertura:</p>
                <ul>
                    <li>De Lunes a Viernes: 11:00 a 02:00</li>
                    <li>Sábados, Domingos y Festivos: 11:30 a 02:00</li>
                </ul>
            </article>
            
            <article id="lista1">
                <p>Horario atención al cliente:</p>
                <ul>
                    <li>Lunes y Martes: 10:00 a 14:00</li>
                    <li>Miercoles, Jueves y Viernes: 16:00 a 20:00</li>
                    <li>Sábados y Domingos: cerrado</li>
                </ul>
            </article> 

            <p id="p5">Número de contacto: 958 52 37 10</p>

            <p id="p1">Fareli Films es un cine que ofrece una experiencia única en el mundo del cine. 
                Ubicado en una zona privilegiada de la ciudad, cuenta con una amplia variedad de películas, 
                desde los grandes estrenos de Hollywood hasta las mejores producciones independientes.</p>

            <p id="p2">Este cine se enorgullece de ofrecer una experiencia de visualización de alta calidad 
                con tecnología de punta. Todas sus salas están equipadas con pantallas gigantes de alta definición, 
                sistemas de sonido envolvente y cómodos asientos reclinables para garantizar que disfrutes de la 
                película en un ambiente cómodo y acogedor.</p>
            
            <p id="p3">Además, Fareli Films se preocupa por ofrecer un servicio excepcional al cliente. Su personal 
                está altamente capacitado para proporcionar una experiencia excepcional desde el momento en que 
                ingresas al cine. Desde la compra de entradas hasta la selección de tu asiento, están disponibles 
                para ayudarte en todo lo que necesites.</p>

            <p id="p4">En resumen, Fareli Films es un cine de alta calidad que ofrece una experiencia de visualización 
                excepcional, un servicio excepcional al cliente y promociones especiales para los amantes del cine. 
                Si estás buscando una experiencia única en el mundo del cine, no dudes en visitar Fareli Films.</p>

        </section>
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