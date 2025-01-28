<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    
<body>

    <header>
        <a href="index.php"><img id="logoCine" src="imagenes/FareliFilms.jpg" alt="Logo del cine"></a>
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

        <?php
        // Comprueba si el usuario ha iniciado sesión

        if(isset($_SESSION['username']) && $_SESSION['rol'] !== 'admin') {
            $navLink1 = '<li><a href="cambiar_datos.php">Cambiar datos personales</a></li>';
        } else {
            $navLink1 = '';
        }
        ?>

        <?php
        // Comprueba si el usuario ha iniciado sesión

        if(isset($_SESSION['username']) && $_SESSION['rol'] === 'admin') {
            $navLink2 = '<li><a href="gestion_admin.php">Administrar peliculas</a></li>';
        } else {
            $navLink2 = '';
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
                <?php echo $navLink1; ?>
                <?php echo $navLink2; ?>
            </ul>
        </nav>

    </header>

    <main>
        <section class="menuPrincipal">
            
            <section id="content">

                <section class="pelisMenu">

                    <article class="tituloSeccion">
                        <h2 class="titulosBody">Estrenos de la semana</h2>
                    </article>

                    <?php
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

                    // Consulta para obtener las primeras tres películas con la categoría 'Estrenos de la semana'
                    $consulta = "SELECT * FROM peliculas WHERE categoria = 'Estrenos de la semana' LIMIT 3;";
                    $resultado = $conexion->query($consulta);

                    // Mostrar la información de las películas
                    if ($resultado->num_rows > 0) {
                        for ($i = 0; $i < $resultado->num_rows; $i++) {
                            $fila = $resultado->fetch_assoc();
                            echo '<article class="seccionPeli' . $i . '"> <a href="peli.php?titulo=' . $fila['titulo'] . '"> ';
                            echo '<img onmouseover="mostrarPopup(event, ' . '&#39;' . $fila['titulo'] . '&#39;' . ', ' . '&#39;' . $fila['tematica'] . '&#39;' . ')"  onmousemove="actualizarPosicion(event)" onmouseout="ocultarPopup()" class="peliculas" src = "' . $fila['direccionFoto1'] . '" alt = "Peli1" width="75%"/>';                            echo '<p>' . $fila['titulo'] . ' | ' . $fila['director'] . ' | ' . $fila['fecha'] . '&#128198 | ' . $fila['tiempo'] . '&#9200</p>';
                            echo '<p>(Intérpretes)' . $fila['interpretes'] . '</p>';
                            echo '<p>' . $fila['valoracionMedia'] . '</p>';
                            echo '</a> <a href="peli.php?titulo=' . $fila['titulo'] . '"><h2>' . $fila['titulo'] . '</h2></a> </article>';
                        }
                    } else {
                        echo '<p class="noPeliculas">No se encontraron películas.</p>';
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>

                    <article class="verTodo">
                        <a href="estrenos.php">Ver todas las peliculas</a>
                    </article>
                </section>
    
                <section class="pelisMenu">

                    <article class="tituloSeccion">
                        <h2 class="titulosBody">Cartelera</h2>
                    </article>

                    <?php
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

                    // Consulta para obtener las primeras tres películas con la categoría 'Estrenos de la semana'
                    $consulta = "SELECT * FROM peliculas WHERE categoria = 'Cartelera' LIMIT 3;";
                    $resultado = $conexion->query($consulta);

                    // Mostrar la información de las películas
                    if ($resultado->num_rows > 0) {
                        for ($i = 0; $i < $resultado->num_rows; $i++) {
                            $fila = $resultado->fetch_assoc();
                            echo '<article class="seccionPeli' . $i . '"> <a href="peli.php?titulo=' . $fila['titulo'] . '"> ';
                            echo '<img onmouseover="mostrarPopup(event, ' . '&#39;' . $fila['titulo'] . '&#39;' . ', ' . '&#39;' . $fila['tematica'] . '&#39;' . ')"  onmousemove="actualizarPosicion(event)" onmouseout="ocultarPopup()" class="peliculas" src = "' . $fila['direccionFoto1'] . '" alt = "Peli1" width="75%"/>';                            echo '<p>' . $fila['titulo'] . ' | ' . $fila['director'] . ' | ' . $fila['fecha'] . '&#128198 | ' . $fila['tiempo'] . '&#9200</p>';
                            echo '<p>(Intérpretes)' . $fila['interpretes'] . '</p>';
                            echo '<p>' . $fila['valoracionMedia'] . '</p>';
                            echo '</a> <a href="peli.php?titulo=' . $fila['titulo'] . '"><h2>' . $fila['titulo'] . '</h2></a> </article>';

                        }
                    } else {
                        echo '<p class="noPeliculas">No se encontraron películas.</p>';
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>

                    <article class="verTodo">
                        <a href="cartelera.php">Ver todas las peliculas</a>
                    </article>
                </section>
                
                <section class="pelisMenu">

                    <article class="tituloSeccion">
                        <h2 class="titulosBody">Más valoradas</h2>
                    </article>

                    <?php
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

                    // Consulta para obtener las primeras tres películas con la categoría 'Estrenos de la semana'
                    $consulta = "SELECT * FROM peliculas WHERE categoria = 'Mas valoradas' LIMIT 3;";
                    $resultado = $conexion->query($consulta);

                    // Mostrar la información de las películas
                    if ($resultado->num_rows > 0) {
                        for ($i = 0; $i < $resultado->num_rows; $i++) {
                            $fila = $resultado->fetch_assoc();
                            echo '<article class="seccionPeli' . $i . '"> <a href="peli.php?titulo=' . $fila['titulo'] . '"> ';
                            echo '<img onmouseover="mostrarPopup(event, ' . '&#39;' . $fila['titulo'] . '&#39;' . ', ' . '&#39;' . $fila['tematica'] . '&#39;' . ')"  onmousemove="actualizarPosicion(event)" onmouseout="ocultarPopup()" class="peliculas" src = "' . $fila['direccionFoto1'] . '" alt = "Peli1" width="75%"/>';                            echo '<p>' . $fila['titulo'] . ' | ' . $fila['director'] . ' | ' . $fila['fecha'] . '&#128198 | ' . $fila['tiempo'] . '&#9200</p>';
                            echo '<p>(Intérpretes)' . $fila['interpretes'] . '</p>';
                            echo '<p>' . $fila['valoracionMedia'] . '</p>';
                            echo '</a> <a href="peli.php?titulo=' . $fila['titulo'] . '"><h2>' . $fila['titulo'] . '</h2></a> </article>';

                        }
                    } else {
                        echo '<p class="noPeliculas">No se encontraron películas.</p>';
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>

                    <article class="verTodo">
                        <a href="masvaloradas.php">Ver todas las peliculas</a>
                    </article>
                </section>

                <section class="pelisMenu">

                    <article class="tituloSeccion">
                        <h2 class="titulosBody">Próximas en exhibición</h2>
                    </article>

                    <?php
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

                    // Consulta para obtener las primeras tres películas con la categoría 'Estrenos de la semana'
                    $consulta = "SELECT * FROM peliculas WHERE categoria = 'Proximas en exhibicion' LIMIT 3;";
                    $resultado = $conexion->query($consulta);

                    // Mostrar la información de las películas
                    if ($resultado->num_rows > 0) {
                        for ($i = 0; $i < $resultado->num_rows; $i++) {
                            $fila = $resultado->fetch_assoc();
                            echo '<article class="seccionPeli' . $i . '"> <a href="peli.php?titulo=' . $fila['titulo'] . '"> ';
                            echo '<img onmouseover="mostrarPopup(event, ' . '&#39;' . $fila['titulo'] . '&#39;' . ', ' . '&#39;' . $fila['tematica'] . '&#39;' . ')"  onmousemove="actualizarPosicion(event)" onmouseout="ocultarPopup()" class="peliculas" src = "' . $fila['direccionFoto1'] . '" alt = "Peli1" width="75%"/>';                            echo '<p>' . $fila['titulo'] . ' | ' . $fila['director'] . ' | ' . $fila['fecha'] . '&#128198 | ' . $fila['tiempo'] . '&#9200</p>';
                            echo '<p>' . $fila['titulo'] . ' | ' . $fila['director'] . ' | ' . $fila['fecha'] . '&#128198 | ' . $fila['tiempo'] . '&#9200</p>';
                            echo '<p>(Intérpretes)' . $fila['interpretes'] . '</p>';
                            echo '<p>' . $fila['valoracionMedia'] . '</p>';
                            echo '</a> <a href="peli.php?titulo=' . $fila['titulo'] . '"><h2>' . $fila['titulo'] . '</h2></a> </article>';

                        }
                    } else {
                        echo '<p class="noPeliculas">No se encontraron películas.</p>';
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>

                    <article class="verTodo">
                        <a href="proximas.php">Ver todas las peliculas</a>
                    </article>
                </section>

            </section>

            <aside class="seccionNoticias">

                <article id="tituloNot">
                    <h2 class="titulosBody">Noticias</h2>
                </article>

                <article class="noticia" id="noticia1">
                    <a href="noticia1.php"> <img class="fotoNoticia" id="fotoNoticia1" src="imagenes/noticia1.jpg" width="60%"></a>
                    <a href="noticia1.php"> <p class="titularNot" id="titular1">Muere la actriz y presentadora española Laura Valenzuela.</p></a>
                </article>

                <article class="noticia" id="noticia2">
                    <a href="noticia2.php"> <img class="fotoNoticia" id="fotoNoticia2" src="imagenes/noticia2.jpg" width="60%"></a>
                    <a href="noticia2.php"> <p class="titularNot" id="titular2">Los rayos láser revelan 5 civilizaciones antiguas que estaban ocultas a plena vista.</p></a>
                </article>

                <article class="noticia" id="noticia3">
                    <a href="noticia3.php"> <img class="fotoNoticia" id="fotoNoticia3"  src="imagenes/noticia3.jpg" width="60%"></a>
                    <a href="noticia3.php"> <p class="titularNot"  id="titular3">Científicos españoles descubren cómo crear nuevos sistemas de edición genética con moléculas que ya no existen.</p></a>
                </article>

                <article class="noticia" id="noticia4">
                    <a href="noticia4.php"> <img class="fotoNoticia" id="fotoNoticia4"  src="imagenes/noticia4.jpg" width="60%"></a>
                    <a href="noticia4.php"> <p class="titularNot"  id="titular4">La prometedora tecnología de purificación de agua que elimina el 99,9% de los microplásticos en 10 segundos.</p></a>
                </article>

                <article class="noticia" id="noticia5">
                    <a href="noticia5.php"> <img class="fotoNoticia" id="fotoNoticia5"  src="imagenes/noticia5.jpg" width="60%"></a>
                    <a href="noticia5.php"> <p class="titularNot"  id="titular5">Este bisturí 'huele' los tumores y es capaz de detectar cáncer de útero con gran velocidad.</p></a>
                </article>

                <article class="noticia" id="noticia6">
                    <a href="noticia6.php"> <img class="fotoNoticia" id="fotoNoticia6"  src="imagenes/noticia6.jpg" width="60%"></a>
                    <a href="noticia6.php"> <p class="titularNot"  id="titular6">El Inter rememora a Mourinho y jugará la final de la Champions 13 años después.</p></a>
                </article>

                <article class="noticia" id="noticia7">
                    <a href="noticia7.php"> <img class="fotoNoticia" id="fotoNoticia7"  src="imagenes/noticia7.jpg" width="60%"></a>
                    <a href="noticia7.php"> <p class="titularNot"  id="titular7">Más cerca de una vacuna universal contra el cáncer.</p></a>
                </article>

                <article class="noticia" id="noticia8">
                    <a href="noticia8.php"> <img class="fotoNoticia" id="fotoNoticia8"  src="imagenes/noticia8.jpg" width="60%"></a>
                    <a href="noticia8.php"> <p class="titularNot"  id="titular8">Encuentran una explicación para el extraño fenómeno del déjà vu.</p></a>
                </article>

                <article class="noticia" id="noticia9">
                    <a href="noticia9.php"> <img class="fotoNoticia" id="fotoNoticia9"  src="imagenes/noticia9.jpg" width="60%"></a>
                    <a href="noticia9.php"> <p class="titularNot"  id="titular9">La economía española registra un crecimiento del 5,2% en el 1º trimestre de 2023</p></a>
                </article>
    
            </aside>

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

    <script>
        var ventanaEmergente = document.createElement('div');
        ventanaEmergente.className = 'popup';
        var ventanaEmergenteTitle = document.createElement('p');
        ventanaEmergenteTitle.id = 'popupTitle';
        ventanaEmergente.appendChild(ventanaEmergenteTitle);
        var ventanaEmergenteCategory = document.createElement('p');
        ventanaEmergenteCategory.id = 'popupCategory';
        ventanaEmergente.appendChild(ventanaEmergenteCategory);
        document.body.appendChild(ventanaEmergente);

        function mostrarPopup(event, title, category) {
            console.log(event); // Imprimir el objeto event en la consola
            var popupTitle = document.getElementById('popupTitle');
            var popupCategory = document.getElementById('popupCategory');
            popupTitle.innerHTML = title;
            popupCategory.innerHTML = category;

            // Mostrar la ventana emergente
            ventanaEmergente.style.display = 'block';

            // Actualizar la posición inicial de la ventana emergente
            actualizarPosicion(event);
        }

        function ocultarPopup() {
            ventanaEmergente.style.display = 'none';
        }

        function actualizarPosicion(event) {
            // Obtener las coordenadas del cursor
            var mouseX = event.pageX;
            var mouseY = event.pageY;

            // Ajustar la posición de la ventana emergente
            ventanaEmergente.style.left = mouseX + 'px';
            ventanaEmergente.style.top = mouseY + 'px';
        }
    </script>

</body>

</html>