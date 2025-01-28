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
            <article><a id="noticiaAnt" href="noticia6.php">Noticia Anterior (6)</a></article>
            <article><a id="noticiaSig" href="noticia8.php">Noticia Siguiente (8)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Más cerca de una vacuna universal contra el cáncer</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia7.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia7_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia7_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia7_4.jpg" width="80%"></article>


            <p id="parrafo1">Experimentos en animales desvelan una nueva vía de estimular al sistema inmune para eliminar tumores 
                resistentes. Desde hace unos años, la frontera de la investigación del cáncer no está dentro del tumor, sino en 
                todo lo que le rodea. Los oncólogos lo denominan microambiente: un mundo microscópico del que aún se entiende muy 
                poco. Las células tumorales avanzan tendiendo nuevos vasos sanguíneos con los que alimentar su crecimiento. En 
                ocasiones también hay células del sistema inmune que parecen dormidas. En el ambiente de los tumores más letales y 
                difíciles de tratar —como los de páncreas o cerebro— apenas hay linfocitos T, el tipo de célula inmunitaria capaz 
                de localizar y aniquilar cualquier amenaza externa. Es como si el cáncer llevase una capa de “invisibilidad”.</p>

            <p id="parrafo2">Uno de los mayores retos de la oncología es conseguir vacunas que convoquen a muchos efectivos distintos 
                del sistema inmune al campo de batalla del microambiente tumoral sin importar en qué órgano esté. Para ello hay que 
                encontrar un mecanismo molecular común a todos esos tumores. Un estudio ha reavivado el sueño de una vacuna polivalente 
                contra el cáncer. Se trata de una nueva molécula identificada por el médico y experto en inmunoterapia Kai Wucherpfennig, 
                del Instituto Dana-Farber de Cáncer, en Boston, que usa una nueva táctica para despojar a los tumores de su invisibilidad. 
                El cáncer daña el ADN de las células y en respuesta a ese daño se producen dos proteínas llamadas MICA Y MICB.</p>

            <p id="parrafo3">En condiciones normales servirían para alertar al sistema inmune, pero las células cancerosas han desarrollado 
                la capacidad de cortarlas y diluirlas, lo que le hace “invisible” ante las defensas del organismo. El equipo de David Mooney, 
                bioingeniero de la Universidad de Harvard, diseñó una vacuna basada en la molécula identificada por su colega del Dana-Farber 
                que genera anticuerpos contra esas dos proteínas. Estas moléculas se unen a ellas e impiden que se les corte. Eso retira la 
                capa de invisibilidad del tumor y hace que al lugar acudan dos tipos de células inmunitarias: linfocitos T y las células 
                asesinas naturales (células killer). Ambas vuelven a ser capaces de identificar las proteínas, se unen a ellas y destruyen 
                las células tumorales donde están presentes. Los científicos han mostrado que la vacuna es efectiva en varios experimentos 
                con ratones y además han observado que genera una respuesta inmune adecuada en monos.</p>
            
            <p id="parrafo4"> Esta inmunización funciona incluso en casos de tumores avanzados que han causado metástasis en los animales. 
                Este nuevo prototipo de vacuna contra el cáncer se ha publicado en Nature, y en breve se iniciarán ensayos en humanos. Este 
                estudio forma parte de una nueva aproximación a la inmunoterapia. La idea consiste en inmunizar para que se formen autoanticuerpos 
                frente a mecanismos que usa el tumor para evadir la respuesta del sistema inmune, de forma que en pacientes vacunados se potencia 
                la efectividad de los tratamientos de inmunoterapia.</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 30/03/2023 - 17:35 / Actualizado: 30/03/2023 - 18:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://www.fundacionquaes.org/retos_biomedicina/un-estudio-acerca-el-sueno-de-una-vacuna-universal-contra-el-cancer/">Ir al sitio Web de la noticia original</a></h3>
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