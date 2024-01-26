<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="btn boton-verde">Volver</a>

    <h1>Seguro que quieres eliminar este vendedor?</h1>

    <div class="resumen-propiedad">
        <h2><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></h2>

        <h3><?php echo $vendedor->telefono ?></h3>

        <form method="post" class="w-100">
            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
            <input type="hidden" name="tipo" value="vendedor">
            <input type="submit" value="Eliminar" class="boton-rojo-block">
        </form>
    </div>
</main>