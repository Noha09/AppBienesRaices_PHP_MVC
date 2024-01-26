<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>

    <img loading="lazy" src="/public/imagenes/<?php echo $blog->imagen; ?>" alt="imagen de la entrada">

    <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha; ?></span> por: <span>Admin.</span></p>

    <div class="resumen-propiedad">
        <p><?php echo $blog->resumen; ?></p>

        <p><?php echo $blog->contenido; ?></p>
    </div>
</main>