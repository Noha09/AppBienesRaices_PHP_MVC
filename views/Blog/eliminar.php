<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="btn boton-verde">Volver</a>

    <h1>Seguro que quieres eliminar esta Entrada?</h1>

    <h2><?php echo $blog->titulo; ?></h2>

    <img loading="lazy" src="/public/imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la entrada">

    <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha; ?></span> por: <span>Admin.</span></p>

    <div class="resumen-propiedad">
        <p><?php echo $blog->resumen; ?></p>

        <p><?php echo $blog->contenido; ?></p>

        <form method="post" class="w-100">
            <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
            <input type="hidden" name="tipo" value="blog">
            <input type="submit" value="Eliminar" class="boton-rojo-block">
        </form>
    </div>
</main>