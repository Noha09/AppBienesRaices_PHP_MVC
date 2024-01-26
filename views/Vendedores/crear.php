<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a href="/admin" class="btn boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error"><?php echo $error ?></div>
    <?php endforeach; ?>

    <form method="post" class="formulario">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Registrar Vendedor(a)" class="btn boton-verde">
    </form> <!-- .formulario -->
</main>