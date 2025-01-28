<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="pelii.css">
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

        <?php
        // Comprueba si el usuario ha iniciado sesión
        if(isset($_SESSION['username']) && $_SESSION['rol'] !== 'admin') {
            $navLink3 = '<form id="formComentarios" action="gestorComentarios.php" method="POST">
          
            <label for="comentario">Comentario (Máximo 500 caracteres):</label>
            <textarea id="comentario" name="comentario" strlen() maxlength="450" oninput="eliminarCaracter(this, ' . '&#39;' . '\&#39;' . '&#39;' . ')" 
            required></textarea>
          
            <label for="valoracionMedia">Valoración:</label>
            <select id="valoracionMedia" name="valoracionMedia" required>
              <option value="">Seleccione una opción</option>
              <option value="&#11088 &#10025 &#10025 &#10025 &#10025">&#11088 &#10025 &#10025 &#10025 &#10025</option>
              <option value="&#11088 &#11088 &#10025 &#10025 &#10025">&#11088 &#11088 &#10025 &#10025 &#10025</option>
              <option value="&#11088 &#11088 &#11088 &#10025 &#10025">&#11088 &#11088 &#11088 &#10025 &#10025</option>
              <option value="&#11088 &#11088 &#11088 &#11088 &#10025">&#11088 &#11088 &#11088 &#11088 &#10025</option>
              <option value="&#11088 &#11088 &#11088 &#11088 &#11088">&#11088 &#11088 &#11088 &#11088 &#11088</option>
            </select>
          
            <button type="submit">Enviar</button>
        </form>';
        } else {
            $navLink3 = '';
        }
        ?>

        <script>
        function eliminarCaracter(elemento, caracter) {
            const valor = elemento.value;
            elemento.value = valor.replace(new RegExp(caracter, 'g'), '');
        }
        </script>

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

        <?php
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "pwrafaelluque";
        $password = "--rafael--";
        $database = "dbrafaelluque_pw2223";
        
        $conn = new mysqli($servername, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        // Obtener la información de la película de la base de datos
        $titulo = $_GET["titulo"]; // Obtener el ID de la película desde la URL
        
        $sql = "SELECT * FROM peliculas WHERE titulo = '$titulo';";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Mostrar la información de la película
            $row = $result->fetch_assoc();
            $tituloPrincipal = '<h2 class="titulosBody">' . $row['titulo'] . '</h2>';
            $titulo = $row['titulo'];
            $_SESSION['titulo'] = $titulo;
            $director = '<article id="dat9"><p>' . $row['director'] . '</p></article>';
            $interpretes = $row["interpretes"];
            $tematica = $row["tematica"];
            $tiempo = $row["tiempo"];
            $valoracionMedia = $row["valoracionMedia"];
            $sinopsis = $row["sinopsis"];
            $direccionFoto1 = $row["direccionFoto1"];
            $direccionFoto2 = $row["direccionFoto2"];
            $direccionFoto3 = $row["direccionFoto3"];
            $direccionFoto4 = $row["direccionFoto4"];  

        } else {
            echo "No se encontró la película";
        }
        
        $conn->close();
        ?>

        <section class="sectionPelis">
            <article id="tituloArticle">
                <?php echo $tituloPrincipal; ?>
            </article>
            <article id="foto1"><img class="peliculas" src = "<?php echo $direccionFoto1; ?>" alt = "FotoVenus1" width="70%"/></article> 
            <article id="foto2"><img class="peliculas" src = "<?php echo $direccionFoto2; ?>" alt = "FotoVenus2" width="70%"/></article>
            <article id="foto3"><img class="peliculas" src = "<?php echo $direccionFoto3; ?>" alt = "FotoVenus3" width="70%"/></article>
            <article id="foto4"><img class="peliculas" src = "<?php echo $direccionFoto4; ?>" alt = "FotoVenus4" width="70%"/></article>
                
            <article id="dat1"><h3>DATOS SOBRE LA PELICULA</h3></article>
            <article id="dat2"><h3>Titulo:</h3></article>
            <article id="dat3"><h3>Director:</h3></article>
            <article id="dat4"><h3>Interpretes:</h3></article>
            <article id="dat5"><h3>Temática:</h3></article>
            <article id="dat6"><h3>Duración:</h3></article>
            <article id="dat7"><h3>Valoración media de los usuarios:</h3></article>
            
            <article id="dat8"><p><?php echo $titulo; ?></p></article>
            <?php echo $director; ?>
            <article id="dat10"><p><?php echo $interpretes; ?></p></article>
            <article id="dat11"><p><?php echo $tematica; ?></p></article>
            <article id="dat12"><p><?php echo $tiempo; ?> &#9200</p></article>
            <article id="dat13"><p><?php echo $valoracionMedia; ?></p></article>

            <article id="sinopsis"><h3>Sinopsis: </h3></article>
            <article id="dat14"><p><?php echo $sinopsis; ?></p></article>
    
        </section>

        <section id="comentarios">
            <h2>COMENTARIOS DE LOS USUARIOS</h2>
            <ul>
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
                    $consulta = "SELECT * FROM comentarios WHERE titulo = '{$_GET['titulo']}';";
                    $resultado = $conexion->query($consulta);

                    // Mostrar la información de las películas
                    $_SESSION['titulo'] = $titulo;
                    if ($resultado->num_rows > 0) {
                        for ($i = 0; $i < $resultado->num_rows; $i++) {
                            $fila = $resultado->fetch_assoc();
                            echo '<li><h3 class="nombreU">Nombre de usuario: </h3><p>' . $fila['username'] . '</p>';
                            echo '<h3 class="comentarioU">Comentario del usuario: </h3><p>' . $fila['comentario'] . '</p>';
                            echo '<section class="rating"><h3 class="valoracionU">Valoración: </h3>';
                            echo '<article class="star">' . $fila['valoracionMedia'] . '</article></section></li>';
                        }
                    } else {
                        echo 'No se encontraron comentarios.';
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                ?>
        
            </ul>
        </section>

        <?php echo $navLink3; ?>
        <script>
            // Obtener referencia al formulario
            var form = document.getElementById('formComentarios');

            // Agregar un evento de escucha al envío del formulario
            form.addEventListener('submit', function(event) {
            // Obtener todos los campos de entrada y textarea del formulario
            var inputs = form.querySelectorAll('input, textarea');

            // Bandera para indicar si hay campos vacíos
            var camposVacios = false;

            // Verificar cada campo de entrada y textarea
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
