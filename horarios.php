<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="horarios.css">
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
        <section id="seccionHorarios"> 

            <article class="tituloSeccion">
                <h2 class="titulosBody">HORARIOS</h2>
            </article>

            <table id="tablaHorarios">
                <thead>
                    <tr>
                        <th>Película</th>
                        <th>Sala 1</th>
                        <th>Sala 2</th>
                        <th>Sala 3</th>
                        <th>Sala 4</th>
                        <th>Sala 5</th>
                        <th>Sala 6</th>
                        <th>Sala 7</th>
                        <th>Sala 8</th>
                        <th>Sala 9</th>
                        <th>Sala 10</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>65</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>As Bestas</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Creed III</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                    </tr>
                    <tr>
                        <td>El Estraño</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Flash</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Huesera</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>John Wick 4</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                    </tr>
                    <tr>
                        <td>La Ballena</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>La Desconocida</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Llaman a la puerta</td>
                        <td>-</td>
                        <td>-</td>
                        <td>5:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>11:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>12:00 PM</td>
                    </tr>
                    <tr>
                        <td>Los Fabelman</td>
                        <td>2:30 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>8:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Retorno a Seul</td>
                        <td>-</td>
                        <td>2:30 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>8:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Scream VI</td>
                        <td>-</td>
                        <td>-</td>
                        <td>2:30 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>8:00 PM</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Secaderos</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>2:30 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>8:00 PM</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Venus</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>2:30 PM</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>8:00 PM</td>
                    </tr>

                </tbody>
            </table>

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