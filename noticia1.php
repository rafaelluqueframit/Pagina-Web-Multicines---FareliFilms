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
            <article><a id="noticiaAnt" href="noticia9.php">Noticia Anterior (9)</a></article>
            <article><a id="noticiaSig" href="noticia2.php">Noticia Siguiente (2)</a></article>
            <article id="tituloNot">
                <h2 id="Not">Muere la actriz y presentadora española Laura Valenzuela</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia1.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia1_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia1_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia1_4.jpg" width="80%"></article>


            <p id="parrafo1">La intérprete fue uno de los principales rostros de Televisión Española en 
                la década de los sesenta y participó en una treintena de películas, muchas 
                de ellas producidas por quien después se convirtió en su marido, José Luis Dibildos</p>

            <p id="parrafo2">Rocío Laura Espinosa López-Cepero, conocida como Laura Valenzuela, ha fallecido 
                este viernes a los 92 años en Madrid, tras pasar los últimos días ingresada en el hospital de 
                La Princesa, según ha podido confirmar EL PAÍS. A las puertas del hospital y antes de partir 
                hacia el tanatorio, la única hija de Valenzuela, Lara Dibildos, de 51 años, ha dado las gracias 
                esta tarde a las muchas personas que han mandado sus condolencias “por todo el cariño y el respeto”, 
                ha expresado vestida de luto y entre lágrimas. “Ha sido duro”, ha afirmado. “Se ha ido en paz”.</p>

            <p id="parrafo3">Laura Valenzuela nació en Sevilla el 18 de febrero de 1931. Tenía pocos recuerdos de su 
                ciudad natal porque su familia se trasladaba frecuentemente de ciudad debido a la profesión de su padre, 
                que era piloto de avión. La mayor de tres hermanos estudió interna durante tres años en un colegio del sur 
                de Francia y también residió en París antes de regresar a Madrid. Tras el Bachillerato comenzó estudios de 
                Comercio, que abandonó porque empezó a trabajar en la oficina de una empresa de grúas y después en una tienda 
                de moda, donde además de asistir a la clientela y gracias a sus medidas (89-64-90) y a su altura (1,71 metros), 
                comenzó a hacer ocasionalmente de maniquí: “Una amiga mía abrió una boutique y me invitó a pasar modelos para 
                su clientela. Me dijo: ‘¡Con ese tipazo que tú tienes!’. Aquello me animó muchísimo porque yo seguía viéndome 
                larguirucha, flaca, desgarbada. Y encima... ¡con cara de aceituna!”, declaró Valenzuela sobre aquellos años, 
                según recogió la revista Pronto.</p>
            
            <p id="parrafo4">Desfiló para firmas de moda de la época como Asunción Bastida o Marbel, pero tal y como relataron 
                en el programa de TVE Lazos de sangre dedicado a su vida en julio de 2020, su recorrido como maniquí terminó 
                abruptamente cuando una clienta muy importante se encaprichó de uno de los modelos que lucía Valenzuela y esta 
                se lo metió en la bolsa con percha incluida. La clienta se enfureció tanto que Valenzuela fue despedida de 
                inmediato. Y es que la compradora era ni más ni menos que la duquesa de Alba.

                Viéndose de patitas en la calle, a través del actor José Luis Ozores, a quien conoció por casualidad, se enteró 
                de que en Televisión Española (TVE) buscaban presentadoras para los estudios del Paseo de La Habana. Esto ocurrió 
                en 1952 y las primeras emisiones de televisión se produjeron en 1956. Valenzuela se presentó y quedó contratada. 
                De hecho, fue la primera presentadora con la que contó la casa y gozó desde el principio de gran popularidad. 
                La presentadora, que formaba parte de la primera promoción de presentadoras de televisión en España, comentó en 
                una entrevista a EL PAÍS de 1996 que ella estaba “en la tele desde que había solo 600 aparatos”. Es natural que 
                los telespectadores se refirieran a esa joven pizpireta que hacía un poco de todo dentro de aquella caja del salón 
                como Laurita, porque era casi de la familia. En 1957 fue galardonada con el Premio Ondas como reconocimiento a su 
                labor en Televisión Española en el primer año que estos premios galardonaban a profesionales que trabajaban en televisión.</p>

            <article id="creadoPor">
                <h3>Por Rafael Luque Framit. 30/03/2023 - 17:35 / Actualizado: 30/03/2023 - 18:49</h3>
            </article>

            <article id="enlaceNoticia">
                <h3><a id="enlaceNot" href="https://elpais.com/gente/2023-03-17/muere-laura-valenzuela-actriz-y-presentadora-a-los-92-anos.html">Ir al sitio Web de la noticia original</a></h3>
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