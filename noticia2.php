<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="noticiai.css">
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
        <section id="noticiasSection">
            <article><a id="noticiaAnt" href="noticia1.php">Noticia Anterior (1)</a></article>
            <article><a id="noticiaSig" href="noticia3.php">Noticia Siguiente (3)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Los rayos láser revelan 5 civilizaciones antiguas que estaban ocultas a plena vista</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia2.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia2_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia2_4.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia2_3.jpg" width="80%"></article>


            <p id="parrafo1">La arqueología ha descubierto antiguas civilizaciones gracias a un láser que permite 
                crear mapas 3D que revelan estructuras construidas por el ser humano.
                Estas se encontraban ocultas a simple vista, entre la densa vegetación o bajo el suelo, pero en los últimos 
                años han sido destapadas con ayuda de un método de medición láser que disparan desde el cielo con aviones 
                teledirigidos: la tecnología de última generación LiDAR (light detection and ranging: detección y alcance de la luz).</p>

            <p id="parrafo2">Las históricas revelaciones han sido una civilización maya de 2.000 años de antigüedad oculta en el norte de 
                Guatemala, centenares de lugares ceremoniales mayas y olmecas desaparecidos hace miles de años en México, miles de 
                estructuras bajo la densa selva guatemalteca desconocidas hasta ahora, más de 80 movimientos de tierra (incluidas aldeas 
                fortificadas y carreteras) en las profundidades de la selva amazónica y una antigua civilización sobrecogedora enterrada 
                en la Amazonía boliviana.</p>

            <p id="parrafo3">Utilizando pulsos láser, los investigadores detectaron una civilización maya de 2.000 años de antigüedad en el 
                norte de Guatemala, con casi 1.000 yacimientos arqueológicos.
                A partir de los mapas topográficos de la zona, han determinado que la civilización constaba de más de 417 ciudades, pueblos 
                y aldeas repartidos en 1.683 kilómetros cuadrados.
                El asentamiento tenía docenas de campos y 284 kilómetros de calzadas por donde podían viajar los antiguos mayas. 
                Arqueólogos resuelven un antiguo misterio sobre Stonehenge: el origen de las icónicas rocas de arenisca del monumento</p>
            
            <p id="parrafo4">En la región brasileña de Mato Grasso, los arqueólogos utilizaron LiDAR para hallar pruebas de 24 yacimientos con 
                81 movimientos de tierra, que incluían la construcción de carreteras interconectadas y aldeas fortificadas edificadas sobre montículos.
                Creen que estas estructuras podrían haber servido de base a una civilización compleja y avanzada con una población de hasta un millón de 
                personas entre los años 1250 y 1500, según publicó con anterioridad Business Insider.
                La increíble historia de Fordlandia, la ciudad utópica en medio del Amazonas que creó Henry Ford y que hoy es un pueblo fantasma
                Algunos de los geoglifos, como llaman los arqueólogos a las figuras dibujadas y excavadas en la tierra, tenían hasta 300 metros de diámetro.
                Puede haber cientos de sitios más escondidos en la selva en una "cadena continua de asentamientos", aseguraba Jonas Gregorio de Souza, autor 
                principal del trabajo, al Wall Street Journal en 2018. "Parece que era un mosaico de culturas".</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 29/03/2023 - 16:35 / Actualizado: 29/03/2023 - 17:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.businessinsider.es/5-antiguas-civilizaciones-escondian-plena-vista-1178486">Ir al sitio Web de la noticia original</a></h3>
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