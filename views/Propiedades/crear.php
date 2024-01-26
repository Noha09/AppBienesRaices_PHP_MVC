<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin" class="btn boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error"><?php echo $error ?></div>
    <?php endforeach; ?>

    <form method="post" class="formulario" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Crear propiedad" class="btn boton-verde">
    </form>
</main>