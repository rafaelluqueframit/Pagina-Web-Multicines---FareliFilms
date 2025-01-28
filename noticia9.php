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
            <article><a id="noticiaAnt" href="noticia8.php">Noticia Anterior (8)</a></article>
            <article><a id="noticiaSig" href="noticia1.php">Noticia Siguiente (1)</a></article>
            <article id="tituloNot">
                <h2 id="Not">La economía española registra un crecimiento del 5,2% en el 1º trimestre de 2023</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia9.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia9_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia9_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia9_4.jpg" width="80%"></article>


            <p id="parrafo1">Según los datos publicados hoy por el Instituto Nacional de Estadística, la economía española ha experimentado un 
                fuerte crecimiento del 5,2% en el primer trimestre de 2023. Este aumento se ha debido principalmente a la recuperación del consumo 
                interno y al aumento de las exportaciones.</p>

            <p id="parrafo2">El consumo interno, que representa alrededor del 60% de la economía española, ha aumentado un 3,8% en comparación con
                 el trimestre anterior, impulsado por el aumento de la confianza de los consumidores y la reducción del desempleo.
                Por otro lado, las exportaciones españolas han aumentado un 6,4%, impulsadas por la demanda de los países de la Unión Europea y los 
                mercados emergentes. Además, la inversión extranjera en España ha seguido siendo sólida, con un aumento del 4,7% en comparación con 
                el trimestre anterior.</p>

            <p id="parrafo3">El gobierno español ha acogido con satisfacción estos resultados y ha destacado que reflejan el éxito de las políticas 
                económicas llevadas a cabo durante los últimos años. Se espera que este crecimiento económico continúe durante el resto del año y que 
                la economía española se recupere por completo de los efectos de la pandemia de COVID-19. El crecimiento del 5,2% en el primer trimestre 
                de 2023 es una excelente noticia para la economía española, que ha estado luchando por recuperarse de la crisis económica provocada por 
                la pandemia de COVID-19. Los datos reflejan una sólida recuperación económica, que ha sido impulsada por el aumento del consumo interno 
                y de las exportaciones.</p>
            
            <p id="parrafo4">El aumento del consumo interno ha sido uno de los principales impulsores del crecimiento económico en el primer trimestre 
                de 2023. Esto se debe en gran parte a la reducción del desempleo y al aumento de la confianza de los consumidores. La tasa de desempleo 
                ha disminuido significativamente en los últimos meses, lo que ha aumentado la capacidad de gasto de los hogares. Además, la confianza de 
                los consumidores ha aumentado gracias a la vacunación contra el COVID-19 y la reducción de las restricciones.

                Otro factor importante que ha contribuido al crecimiento económico en el primer trimestre de 2023 ha sido el aumento de las exportaciones. 
                La demanda de los países de la Unión Europea y de los mercados emergentes ha aumentado, lo que ha impulsado el crecimiento económico en 
                España. La inversión extranjera también ha aumentado, lo que ha contribuido a la creación de empleo y a la mejora de la situación económica 
                en general.
                
                El gobierno español ha destacado que estos datos son el resultado de las políticas económicas llevadas a cabo durante los últimos años. 
                Se espera que este crecimiento económico continúe durante el resto del año, lo que permitirá a España recuperarse por completo de los efectos 
                de la pandemia de COVID-19. No obstante, se prevén algunos desafíos a medida que se avanza en la recuperación económica, incluyendo el aumento 
                de los precios y la inflación, que podrían afectar el poder adquisitivo de los consumidores y reducir el crecimiento económico a medio y largo 
                plazo.</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 04/04/2023 - 17:35 / Actualizado: 05/04/2023 - 18:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.20minutos.es/noticia/5067724/0/el-fmi-recorta-el-crecimiento-de-la-economia-espanola-al-1-2-en-2023-la-peor-prevision-de-los-grandes-analistas/">Ir al sitio Web de la noticia original</a></h3>
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