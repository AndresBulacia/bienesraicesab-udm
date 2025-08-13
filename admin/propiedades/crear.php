<?php 
    require '../../includes/funciones.php';
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        
        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" placeholder="Titulo Propiedad">
                
                <label for="preco">Precio:</label>
                <input type="number" id="precio" placeholder="Precio Propiedad">
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="5">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ej: 3" min="1" max="3">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="5">
            </fieldset>
            
            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="" id="">
                    <option value="1">Juan</option>
                    <option value="2">Andrés</option>
                </select>
            </fieldset>
            
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
        <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    </main>

    <?php 
    incluirTemplate('footer');
    ?>