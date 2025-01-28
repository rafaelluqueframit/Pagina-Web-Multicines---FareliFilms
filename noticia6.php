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
            <article><a id="noticiaAnt" href="noticia5.php">Noticia Anterior (5)</a></article>
            <article><a id="noticiaSig" href="noticia7.php">Noticia Siguiente (7)</a></article>
            <article id="tituloNot">
                <h2 id="Not">El Inter rememora a Mourinho y jugará la final de la Champions 13 años después</h2>
            </article>
            <article id="fotoNot1"><img class="fotoNoticia" src="imagenes/noticia6.jpg" width="80%"></article>
            <article id="fotoNot2"><img class="fotoNoticia" src="imagenes/noticia6_2.jpg" width="80%"></article>
            <article id="fotoNot3"><img class="fotoNoticia" src="imagenes/noticia6_3.jpg" width="80%"></article>
            <article id="fotoNot4"><img class="fotoNoticia" src="imagenes/noticia6_4.jpg" width="80%"></article>


            <p id="parrafo1">El equipo 'nerazzurro', que no disputa la final de la Copa de Europa desde el triplete de 2010, se deshace de 
                un Milan liquidado ya en la ida y rematado en el Giuseppe Meazza por Lautaro (1-0). Cómo entender el fútbol. No debía ser el Inter 
                un equipo que intimidara en esta Champions. Encuadrado en la liguilla junto a Bayern y Barcelona, nadie parecía reparar en los 
                nerazzurri, con mucha más historia que presente a reivindicar. Pero, tras sobrevivir a aquella primera trampa y agradecer unos 
                cruces de lo más apetecibles (Oporto, Benfica, y por último su enemigo ciudadano, el Milan), el Inter, tercero en la Serie A a 
                17 puntos del campeón Nápoles, ha alcanzado el último escalón europeo. Y podrá rememorar el próximo 10 de junio en la final de 
                Estambul, frente al vencedor del Manchester City-Real Madrid, aquel tiempo en que José Mourinho conquistó la tercera y última Copa 
                de Europa para el club en 2010.</p>

            <p id="parrafo2">No parece sencillo establecer comparaciones con aquellas escuadras interistas que hicieron historia en el fútbol europeo. 
                En 1964, Helenio Herrera en el banquillo y Sandro Mazzola y Luis Suárez en el campo tumbaron al Real Madrid de Di Stéfano, Gento y 
                Puskas en la final de Viena. Un año después, H. H. se deshacía de otro equipo de leyenda, el Benfica de Eusebio, en una final disputada 
                al abrigo del Giuseppe Meazza. Mientras que en 2010, cuando el Inter reinó por última vez en Europa tras vencer al Bayern de Van Gaal 
                en el Bernabéu, podían enumerarse las estrellas: desde el eterno capitán Zanetti, pasando por un Samuel Eto'o que venía de ejercer de 
                lateral en la pared plantada en semifinales frente al Barça de Guardiola en el Camp Nou, un delantero al que le sobraba oficio en el 
                área (Diego Milito), pero sobre todo un entrenador, Mourinho, que convirtió cada partido en una misión sólo para creyentes. Y que 
                adquirió la categoría de líder mesiánico para la hinchada del Inter.</p>

            <p id="parrafo3">El Inter de estos tiempos poco tiene que ver. Sin la familia Moratti en el palco, gobernado por el heredero de un holding 
                chino (Steven Zhang), y con el argentino Lautaro Martínez como gran referente ofensivo y también capitán, tiene también en su entrenador, 
                Simone Inzaghi, a alguien más que preparado para exprimir cada uno de los episodios que determinan el fútbol. Lo hizo en la ida del Derby 
                della Madonnina, cuando lo jugó todo a la carta de un arranque arrebatador para frustrar al Milan con dos goles en diez minutos en San Siro.
                 Y lo hizo en la vuelta, ya como local en el templo pagano de la Lombardía, cuando supo contener a unos rossoneri a los que de poco les 
                 sirvió recuperar a Rafael Leao para la causa. Cuentan que el fútbol italiano está volviendo. Han amontonado a equipos en las últimas rondas 
                 europeas. Pero luego uno repara en que el dorsal diez del Milan, siete veces campeón de Europa, es Brahim Díaz. Un mediapunta más que correcto, 
                 sin duda. Pero exento de ese aura que distingue a los jugadores terrenales de los que no lo son. Brahim, a los diez minutos, se encontró con 
                 que tenía la pelota frente a él, unos centímetros más allá del punto de penalti. Y el portero Onana, preparado para un disparo a bocajarro, 
                 no tuvo más que mantener la posición y aguardar a que le llegara la pelota. El Milan, quizá en ese momento, entendiera ya que no habría manera 
                 de levantar la eliminatoria. Más aun después de ver cómo Leao, la primera vez que intervino, se giró tan lento que el tiempo pareció detenerse 
                 a su alrededor.</p>
            
            <p id="parrafo4">El extremo portugués, sin duda el único futbolista del grupo de Pioli con capacidad para reconstruir guiones, volvió a intentarlo 
                una vez más. El árbitro no vio que la pelota le golpeaba en la mano. Poco importó. Dejó atrás a Dimarco con enorme facilidad y en tierra a Acerbi 
                con un recorte hecho con tijeras de niño. Falló, sin embargo, en la culminación, con un remate demasiado cruzado. El Inter, al que no le hacía 
                falta llegar con demasiado peligro a las inmediaciones de Maignan, se dispuso a esperar con calma. Barella no tuvo 
                demasiados problemas para comerle la moral a Krunic y Tonali, responsables de una creatividad inexistente ante la ausencia por lesión de Bennacer. 
                Y los minutos pudieron ir cayendo como losas a la espera de una revolución del Milan que nunca llegó. Lautaro, invisible en el éxito argentino en 
                el Mundial de Qatar, pero que encontró en aquella contradictoria experiencia un buen motivo para volver a creer en él, se subió a las vallas del 
                Meazza. Luego a una publicidad. Y todo pareció poco tras colorear el desconcierto previo en el área entre Gosens y Lukaku, recién ingresados en el 
                campo, y clavar en la red un zurdazo que ni siquiera supo prever Maignan, batido por el palo corto. Lautaro alzó el puño de un Inter que, llegados a este punto, a nadie teme.</p>

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