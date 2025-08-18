<?php 

    // Importar base de datos
    require '../includes/config/database.php';
    $db = conectarDB();

    // Escribir Query
    $query = "SELECT * FROM propiedades";

    // Consultar Query
    $resultadoConsulta = mysqli_query($db, $query);


    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Incluye template
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if (intval($resultado)  === 1): ?>
            <p class="alerta exito">Anuncio Creado Correctamente!</p>
            <?php elseif(intval($resultado)  === 2): ?>
                <p class="alerta exito">Anuncio Actualizado Correctamente!</p>
        <?php endif ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <!-- Mostrar los resultados -->
            <tbody>
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td> <?php echo $propiedad['titulo']; ?> </td>
                    <td>$ <?php echo $propiedad['precio']; ?> </td>
                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de casa"></td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'] ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <?php 
    // Cerrar la conexion
    mysqli_close($db);

    incluirTemplate('footer');
    ?>