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
            <article><a id="noticiaAnt" href="noticia7.php">Noticia Anterior (7)</a></article>
            <article><a id="noticiaSig" href="noticia9.php">Noticia Siguiente (9)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Encuentran una explicación para el extraño fenómeno del déjà vu</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia8.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia8_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia8_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia8_4.jpg" width="80%"></article>


            <p id="parrafo1">Cuando experimentas un déjà vu, tienes la sensación de haber vivido antes una situación que se está produciendo 
                por primera vez. La ciencia trata de investigar este fallo por el cual el cerebro experimenta el presente como si fuese un 
                recuerdo antiguo. Un nuevo estudio señala que es más probable que un déjà vu ocurra cuando las personas se encuentran en una 
                escena que contiene la misma disposición espacial de elementos que otra ya vivida, pero que no recuerdan conscientemente. </p>

            <p id="parrafo2">Estás cocinando, disfrutando de una noche de verano con unos amigos, hablando por teléfono, paseando por la calle 
                y... ¡pum! Se produce un déjà vu, lo que de forma coloquial a veces se conoce como fallo en Matrix —aludiendo a la escena en la 
                que Neo ve un gato negro y de inmediato ve otro gato idéntico pasando por el mismo lugar—. La extraña sensación del déjà vuhace 
                que, aunque sepas que es imposible, sientas que has experimentado exactamente la misma situación con anterioridad. Desde hace 
                siglos el curioso fenómeno, comúnmente asociado a lo paranormal, ha intrigado a filósofos, neurólogos y escritores durante mucho 
                tiempo.</p>

            <p id="parrafo3">Sobre el déjà vu se ha dicho de todo: que es una habilidad psíquica, que guarda relación con vidas pasadas o que está 
                relacionado con lo sobrenatural. A comienzos de siglo, el científico Alan Brown analizó encuestas y documentos obtenidos hasta la 
                fecha y llegó a la conclusión de que 2 de cada 3 personas experimentan un déjà vu en algún momento de sus vidas. Este investigador 
                determinó que el desencadenante más común del fenómeno se trata de una escena o un lugar. El siguiente detonante más habitual se 
                trata de una conversación. El investigador también registró indicios en la literatura médica que asocian la experiencia con algunos 
                tipos de actividad convulsiva en el cerebro.</p>
            
            <p id="parrafo4">Un artículo publicado en The Conversation y firmado por Anne Cleary, profesora de psicología cognitiva en la Universidad 
                Estatal de Colorado, relata como el equipo de investigación de esta científica se propuso demostrar las hipótesis de hace un siglo sobre 
                los posibles mecanismos del déjà vu. La hipótesis plasmada por Alan Brown se denominó la hipótesis de la familiaridad Gestalt: esta 
                sugiere que el déjà vu puede suceder cuando existe una semejanza espacial entre una escena actual y una escena no recordada en tu memoria. 
                Dicho de otra manera, el diseño de un espacio nuevo podría ser parecido al de otro en el que has estado, pero que conscientemente no recuerdas. 
                La escena, la ubicación de los muebles y los objetos particulares podrían conforman una estructural similar que te haga pensar: yo he estado 
                aquí antes y ya lo he vivido. Los científicos probaron esta idea en el laboratorio utilizando realidad virtual para ubicar a las personas dentro 
                de las escenas. Gracias a la tecnología manipularon los entornos para que algunas escenas compartiesen el mismo patrón de diseño espacial, 
                y otras, no. El resultado confirmó la hipótesis: los déjà vu eran más probables cuando los sujetos se hallaban en una escena que contenía la misma 
                disposición espacial de elementos que una escena anterior que habían visto, pero que no recordaban. Por tanto, la semejanza espacial se confirma 
                como factor de ese pequeño cortocircuito cerebral. Aún queda mucho por saber. Mientras, la ciencia sigue buceando en conocer nuevos factores.</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 30/03/2023 - 17:35 / Actualizado: 30/03/2023 - 18:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.businessinsider.es/ciencia-encuentran-nueva-explicacion-deja-vu-1135493">Ir al sitio Web de la noticia original</a></h3>
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