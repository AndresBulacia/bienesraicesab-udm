<?php 

    // BASE DE DATOS
    require '../../includes/config/database.php';
    $db = conectarDB();
    // var_dump($db);

    // Arreglo con mensaje de errores.
    $errores = [];
    
    // Ejecuta el código después de que el usuario envía el formulario.
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // echo '<pre>';
        // var_dump($_POST);
        // '</pre>';

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedores_id = $_POST['vendedor'];

        if (!$titulo) {
            $errores[] = "Debes añadir un titulo.";
        }
        
        if (!$precio) {
            $errores[] = "Debes añadir un precio.";
        }
        
        if (strlen($descripcion) < 50) {
            $errores[] = "Debes añadir una descripcion.";
        }
        
        if (!$habitaciones) {
            $errores[] = "Falta asignar las habitaciones.";
        }
        
        if (!$wc) {
            $errores[] = "Falta asignar los wc.";
        }
        
        if (!$estacionamiento) {
            $errores[] = "El numero de estacionamiento es obligatorio.";
        }
        
        if (!$vendedores_id) {
            $errores[] = "Debes seleccionar un vendedor.";
        }

        // echo '<pre>';
        // var_dump($errores);
        // '</pre>';
        // exit;

        // Revisar que el arreglo de errores este vacio
        if (empty($errores)) {
            // Insertar en la db
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id');";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                echo 'Cargado correctamente';
            }
        }

        
    }


    require '../../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="5">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="3">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="5">
            </fieldset>
            
            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedor" id="vendedor">
                    <option value="" selected disabled>--Seleccione--</option>
                    <option value="1">Juan</option>
                    <option value="2">Andrés</option>
                </select>
            </fieldset>
            
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>

        <?php foreach($errores as $error): ?>
            <div class="altera error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    </main>

    <?php 
    incluirTemplate('footer');
    ?>