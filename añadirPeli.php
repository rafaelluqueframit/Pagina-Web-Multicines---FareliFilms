<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="altausuarios.css">
        <script src="imagenesJava.js"></script>
        <style>
        
        img{
            border: 2px solid black;
            border-radius: 5px;
            width: 200px; /* Tamaño fijo del ancho */
            object-fit: cover; /* Ajuste de la imagen para llenar el tamaño del borde */
            box-shadow: 0 0 10px rgba(0, 0, 0);
        }

        .selected{
            border: 2px solid black;
            border-radius: 5px;
            width: 200px; /* Tamaño fijo del ancho */
            object-fit: cover; /* Ajuste de la imagen para llenar el tamaño del borde */
            box-shadow: 0 0 10px rgba(0, 0, 0);
            margin: 2%;
        }

        </style>      
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
            <article id="titAlta"><h2 class="titulosBody">Formulario Añadir Pelicula</h2></article>
            <form id="formAlta" action="gestor_añadir_pelicula.php" method="POST">

                <label class="labelAlta" for="titulo">Título (*) (Máximo 80 caracteres):</label>
                <input class="inputAlta" type="text" id="tituloNuevo" pattern="^[^']*?$" strlen() maxlength="80" name="titulo" required>

                <label class="labelAlta" for="director">Director (*) (Máximo 40 caracteres):</label>
                <input class="inputAlta" type="text" id="director" pattern="^[^']*?$" strlen() maxlength="40" name="director" required>

                <label class="labelAlta" for="fecha">Fecha estreno (*):</label>
                <input class="inputAlta" type="date" id="fecha" name="fecha" required>

                <label class="labelAlta" for="interpretes">Intérpretes (*) (Máximo 200 caracteres):</label>
                <input class="inputAlta" type="text" id="interpretes" pattern="^[^']*?$" strlen() maxlength="200" name="interpretes" required>

                <label class="labelAlta" for="tematica">Temática (*) (Máximo 80 caracteres):</label>
                <input class="inputAlta" type="text" id="tematica" pattern="^[^']*?$" strlen() maxlength="80" name="tematica" required>
                
                <label class="labelAlta" for="tiempo">Duración (*):</label>
                <input class="inputAlta" type="number" id="tiempo" min="1" name="tiempo" required>

                <label class="labelAlta" for="valoracionMedia">Valoración media (*):</label>
                <select id="valoracion" name="valoracionMedia" required>
                <option value="">Seleccione una opción</option>
                <option value="&#11088 &#10025 &#10025 &#10025 &#10025">&#11088 &#10025 &#10025 &#10025 &#10025</option>
                <option value="&#11088 &#11088 &#10025 &#10025 &#10025">&#11088 &#11088 &#10025 &#10025 &#10025</option>
                <option value="&#11088 &#11088 &#11088 &#10025 &#10025">&#11088 &#11088 &#11088 &#10025 &#10025</option>
                <option value="&#11088 &#11088 &#11088 &#11088 &#10025">&#11088 &#11088 &#11088 &#11088 &#10025</option>
                <option value="&#11088 &#11088 &#11088 &#11088 &#11088">&#11088 &#11088 &#11088 &#11088 &#11088</option>
                </select>

                <br><br><label class="labelAlta" for="sinopsis">Sinopsis (*) (Máximo 1500 caracteres):</label>
                <textarea class="inputAlta" name="sinopsis" strlen() maxlength="1500" oninput="eliminarCaracter(this, '\'')" required></textarea>

                <script>
                function eliminarCaracter(elemento, caracter) {
                    const valor = elemento.value;
                    elemento.value = valor.replace(new RegExp(caracter, 'g'), '');
                }
                </script>

                <label class="labelAlta" for="categoria">Categoría:</label>
                <select id="valoracion" name="categoria" required>
                <option value="">Seleccione una opción</option>
                <option value="Estrenos de la semana">Estrenos de la semana</option>
                <option value="Cartelera">Cartelera</option>
                <option value="Mas valoradas">Mas valoradas</option>
                <option value="Proximas en exhibicion">Proximas en exhibicion</option>
                </select>

                <br><br><label class="labelAlta" for="imagenes">Selecciona 4 imagenes (*):</label>
                <div>
                    <button type="button" onclick="previousImage()">Anterior</button>
                    <img id="image" src="" alt="Imagen">
                    <button type="button" onclick="nextImage()">Siguiente</button>
                </div>
                <br><div>
                    <button type="button" onclick="selectImage()">Seleccionar</button>
                </div>
                <div id="selectedImagesContainer"></div>
                <input type="hidden" id="selectedImages" name="selectedImages">

                <br><br><br><button type="submit" value="Enviar" onclick="return validateForm();">Enviar</button>
                <input type = "reset" value = "Reiniciar formulario" />
                <h4 class="mensaje">Gracias por añadir la película.</h4>
            </form>
        </section>
        <script>
            // Obtener referencia al formulario
            var form = document.getElementById('formAlta');

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