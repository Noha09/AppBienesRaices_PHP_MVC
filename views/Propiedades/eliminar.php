<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="btn boton-verde">Volver</a>

    <h1>Seguro que quieres eliminar esta Propiedad?</h1>

    <h2><?php echo $propiedad->titulo; ?></h2>

    <img loading="lazy" src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="/public/build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad->descripcion ?></p>

        <form method="post" class="w-100">
            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
            <input type="hidden" name="tipo" value="propiedad">
            <input type="submit" value="Eliminar" class="boton-rojo-block">
        </form>
    </div>
</main>