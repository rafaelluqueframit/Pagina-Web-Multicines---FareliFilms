<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>My Cinema</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="noticiai.css">
        <meta http-equiv="Content-Type" content="video/mp4">
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
            <article><a id="noticiaAnt" href="noticia4.php">Noticia Anterior (4)</a></article>
            <article><a id="noticiaSig" href="noticia6.php">Noticia Siguiente (6)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Este bisturí 'huele' los tumores y es capaz de detectar cáncer de útero con gran velocidad</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia5.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia5_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia5_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia5_4.jpg" width="80%"></article>


            <p id="parrafo1">Tecnología puntera al servicio de la medicina: el iKnife, bisturí capaz de detectar tumores,
                 se ha mostrado eficaz para encontrar cáncer de útero en cuestión de segundos. Se trata de un avance clave 
                 para que miles de mujeres accedan a un diagnóstico temprano, reduciendo el estrés y la carga emocional que implica la espera.
                Un equipo de investigadores financiado por la Unión Europea lanzó esta herramienta quirúrgica innovadora en 2013. 
                El cuchillo inteligente permite diferenciar tejidos sanos de cancerosos a través de la técnica de la espectrometría de masas.</p>

            <p id="parrafo2">Ahora, expertos del Imperial College de Londres han descubierto que el iKnife, ya eficaz a la hora de tratar 
                cánceres de mama y de cerebro, es capaz de detectar con gran precisión y rapidez la presencia de cáncer de endometrio.
                "El iKnife diagnosticó con fiabilidad el cáncer de endometrio en cuestión de segundos, con una precisión diagnóstica del 89%, 
                lo que minimiza los retrasos que sufren actualmente las mujeres a la espera de un diagnóstico histopatológico", señala el nuevo 
                artículo publicado en la revista Cancers. </p>

            <p id="parrafo3">¿Cómo funciona este instrumento pionero? Lo que hace es emplear corrientes eléctricas para diferenciar entre tejido 
                canceroso y sano, analizando el humo que se emite al vaporizar el tejido de la biopsia tras extraerlo del útero.
                En las pruebas realizadas con muestras de tejido de 150 biopsias de mujeres con sospecha de cáncer de endometrio, los resultados 
                se compararon con otros métodos de diagnóstico. El siguiente paso será un gran ensayo clínico para generalizar el uso de este cuchillo, 
                recoge The Guardian. "El cáncer de útero tiene un síntoma de 'bandera roja' que es la hemorragia posmenopáusica, que siempre debe 
                comprobarse con una derivación del médico de cabecera a las dos semanas. Esperar otras dos semanas para obtener los resultados puede 
                ser muy duro para las pacientes", anota Athena Lamnisos, directora ejecutiva de la organización benéfica Eve Appeal, que financió la investigación</p>
            
            <p id="parrafo4">Dado que las hemorragias vaginales anómalas tras la menopausia pueden deberse a numerosos factores, una prueba diagnóstica que 
                descarte o detecte el cáncer de inmediato es un paso de gigante. En el 90% de las mujeres con este tipo de problema, la causa del sangrado 
                no es cáncer. La espera pasará de varias semanas a segundos, evitando semanas de ansiedad y frustración. Los resultados son tremendamente positivos: 
                el iKnife demostró una alta precisión diagnóstica del 89% y un valor predictivo positivo del 94%. Dicho de otro modo, el bisturí permite tranquilizar 
                rápidamente a la persona: la posibilidad de padecer cáncer es realmente baja si el dato del iKnife es negativo, mientras que si es positivo pueden 
                acelerarse las pruebas y exploraciones adicionales. Además del tiempo —que pasa de las 2 semanas habituales a prácticamente un parpadeo—, el método 
                implica otras ventajas: la espectrometría de masas propicia una fácil interpretación, tiene una elevada sensibilidad, una especificidad extraordinaria 
                y resulta poco invasiva para los pacientes, permitiendo realizar análisis en tiempo real de tumores y tejidos extraídos.</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 30/03/2023 - 17:35 / Actualizado: 30/03/2023 - 18:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.businessinsider.es/cientificos-consiguen-restaurar-ereccion-penes-lesionados-1180008">Ir al sitio Web de la noticia original</a></h3>
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