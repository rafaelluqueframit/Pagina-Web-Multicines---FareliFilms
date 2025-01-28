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
            <article><a id="noticiaAnt" href="noticia2.php">Noticia Anterior (2)</a></article>
            <article><a id="noticiaSig" href="noticia4.php">Noticia Siguiente (4)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Científicos españoles descubren cómo crear nuevos sistemas de edición genética con moléculas que ya no existen</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia3.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia3_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia3_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia3_4.jpg" width="80%"></article>

            <p id="parrafo1">La mejora de las técnicas de edición genética que existen en la actualidad 
                podría suponer la cura de numerosas enfermedades y, en general, un hito para la ciencia. 
                Para ello, se buscan nuevas proteínas por casi cada rincón del planeta. Para ello, un grupo de científicos españoles
                de muchas universidades e institutos privados de España, así como laboratorios privados, han descubierto cómo crear nuevos 
                sistemas de edición genética con moléculas que ya no existen.</p>

            <p id="parrafo2">Ahora, un equipo de científicos españoles ha ido más allá y ha logrado resucitar proteínas 
                de organismos que vivieron hace miles de millones de años, pero que ya se encuentran extintos, informa El País.
                Lo han conseguido mediante la recreación de enzimas Cas9, base del sistema CRISPR, que es una revolucionaria 
                tecnología de edición genética que ya ha sido decisiva en el 2022.
                "Será una tecnología que existirá mucho despues de que muramos": las startups de edición genética avanzan pese al impacto de la recesión.</p>

            <p id="parrafo3">"Aquí investigamos la evolución de Cas9 a partir de nucleasas antiguas resucitadas (anCas) en especies 
                extintas de firmicutes que vivieron por última vez 2.600 millones de años antes del presente", explican los autores en 
                el estudio, publicado en Nature Microbiology este lunes 2.
                Tras crear nuevos sistemas CRIPR con estas proteínas e inyectarlas en células humanas, los expertos concluyen que esta 
                enzima antigua resucitada "es capaz de editar la actividad en células humanas".</p>
            
            <p id="parrafo4">Desde que alcanzó su punto máximo en febrero de 2021, el sector biotecnológico ha experimentado un largo y 
                doloroso declive. El ETF SPDR S&P Biotech, un índice biotecnológico líder, ha perdido más de la mitad de su valor durante ese lapso de tiempo.

                Si bien las razones de la recesión son variadas, la crisis económica más amplia ha afectado duramente a la biotecnología. 
                El aumento de las tasas de interés perjudicó especialmente al sector, que depende de los mercados de capitales para obtener financiamiento. 
                
                Hoy en día, la mayoría de las biotecnologías no son rentables ni generan ingresos, ya que se necesitan años para que se apruebe un 
                solo fármaco. Las tasas de interés más altas dificultan la obtención de efectivo, un problema agravado por la cantidad de biotecnologías 
                que se lanzaron a la piscina en los últimos años de bonanza.  </p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 28/03/2023 - 15:35 / Actualizado: 28/03/2023 - 14:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.elconfidencial.com/tecnologia/ciencia/2023-01-02/cientificos-reconstruyen-proteinas-2600-millones-anos_3551407/">Ir al sitio Web de la noticia original</a></h3>
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