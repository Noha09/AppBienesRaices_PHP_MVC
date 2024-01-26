<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo de la Entrada" value="<?php echo s($blog->titulo); ?>">

    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="blog[contenido]"><?php echo s($blog->contenido); ?></textarea>

    <label for="resumen">Resumen:</label>
    <textarea id="resumen" name="blog[resumen]"><?php echo s($blog->resumen); ?></textarea>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">

    <?php if ($blog->imagen) : ?>
        <img src="/public/imagenes/<?php echo $blog->imagen; ?>" class="img-small">
    <?php endif; ?>
</fieldset>

<fieldset>
    <legend>Autor</legend>

    <select name="blog[vendedorId]" id="vendedorId">
        <option selected value=""><-- Seleccione --></option>
        <?php foreach ($vendedores as $vendedor) : ?>
            <option <?php echo $blog->vendedorId === $vendedor->id ? 'selected' : ''; ?> value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>