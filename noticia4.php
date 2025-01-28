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
            <article><a id="noticiaAnt" href="noticia3.php">Noticia Anterior (3)</a></article>
            <article><a id="noticiaSig" href="noticia5.php">Noticia Siguiente (5)</a></article>
            <article id="tituloNot">
                <h2 id="Not">La prometedora tecnología de purificación de agua que elimina el 99,9% de los microplásticos en 10 segundos</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia4.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia4_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia4_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia4_4.jpg" width="80%"></article>

            <p id="parrafo1">Los microplásticos son un problema medioambiental y están por todas partes: se han hallado en las cumbres 
                más altas, las fosas más profundas, los lugares más alejados e incluso dentro del cuerpo humano, en varias partes del 
                mismo y en las placentas de bebés que aún no han nacido. Ese contexto da aún mayor relevancia a soluciones como la que 
                aportan investigadores de Corea del Sur, que han desarrollado un nuevo sistema de depuración de agua que puede filtrar 
                estos diminutos fragmentos y otras sustancias contaminantes con una enorme velocidad y eficacia. Han creado un proyecto de impresión
                artística del prototipo del sistema de filtración de agua.</p>

            <p id="parrafo2">Los científicos han diseñado un prototipo de una tecnología de filtración de microplásticos basada en un material 
                clave, conocido como marco covalente de triazeno (CTF), que es muy poroso y con una gran capacidad de almacenar las moléculas que captura. 
                Así, el filtro resultante ha mostrado que puede eliminar más del 99,9% de los contaminantes en solo 10 segundos. A eso se une que 
                puede reutilizarse varias veces sin ver reducido su rendimiento.</p>

            <p id="parrafo3">Además, en otro experimento los investigadores han desarrollado una versión diferente del polímero capaz de absorber la luz 
                solar, convertir la energía en calor y purificar otro contaminante —los compuestos orgánicos volátiles (COV)—.
                "Una experta explica cómo limpiar tu botella de agua reutilizable para no convertirla en un nido de bacterias".</p>
            
            <p id="parrafo4">Acechan en cada rincón y son un problema medioambiental de cada vez mayor magnitud. Mientras la ciencia pisa el acelerador 
                para saber cómo impactan en la salud animal y humana, los microplásticos multiplican su presencia, llegando a las cumbres más altas, las 
                fosas más profundas y los lugares más alejados del planeta, como la remota Antártida o el Polo Norte.
                Dentro del cuerpo humano, estas partículas microscópicas ya se han hallado en la sangre, en la parte más profunda de los pulmones, en las 
                placentas de bebés que aún no han nacido, en el intestino, y hasta en la leche materna. También están en el agua que bebemos, especialmente 
                en la embotellada. También la lluvia en todo el mundo posee "sustancias químicas eternas" que causan cáncer. </p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 27/03/2023 - 14:35 / Actualizado: 27/03/2023 - 13:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.businessinsider.es/invento-elimina-999-microplasticos-agua-10-segundos-1178394">Ir al sitio Web de la noticia original</a></h3>
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