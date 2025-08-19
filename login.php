<?php 

    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];

    // Autenticar el usuario
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El Email es obligatorio o no es valido.";
        }

        if (!$password) {
            $errores[] = "El Password es obligatorio.";
        }
        
        if (empty($errores)) {

            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}';";
            $resultado = mysqli_query($db, $query);

            
            if ($resultado->num_rows) {
                
                // Revisar que el password sea correcta
                $usuario = mysqli_fetch_assoc($resultado);
                // var_dump($usuario['password']);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);
                
                if ($auth) {
                    // Usuario autenticado
                    session_start();
                } else {
                    $errores[] = "Contraseña incorrecta.";
                }
                
                
            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }



    // Incluye el Header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?> 
            <div class="alerta error">
                <?php echo $error; ?> 
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail:</label>
                <input id="email" name="email" type="email" placeholder="Tu Email">

                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="Tu Password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

    <?php 
    incluirTemplate('footer');
    ?>