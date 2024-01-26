<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php }
    } ?>

    <a href="/propiedades/crear" class="btn boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="btn boton-amarillo">Nuevo(a) Vendedor</a>
    <a href="/blog/crear" class="btn boton-amarillo">Nueva Entrada</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody><!-- Monstramos las propiedades -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        <a href="/propiedades/eliminar?id=<?php echo $propiedad->id; ?>" class="boton-rojo-block">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><!-- .propiedades -->

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody><!-- Monstramos las propiedades -->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="/vendedores/eliminar?id=<?php echo $vendedor->id; ?>" class="boton-rojo-block">Eliminar</a>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><!-- .vendedores -->

    <h2>Entradas del Blog</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>TITULO</th>
                <th>IMAGEN</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($blogs as $entrada) : ?>
                <tr>
                    <td><?php echo $entrada->id; ?></td>
                    <td><?php echo $entrada->titulo; ?></td>
                    <td><img src="/public/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen propiedad" class="imagen-tabla"></td>
                    <td>
                        <a href="/blog/eliminar?id=<?php echo $entrada->id; ?>" class="boton-rojo-block">Eliminar</a>
                        <a href="/blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>