<?php foreach ($blogs as $entrada) : ?>
    <article class="entrada-blog">
        <div class="imagen">
            <img src="/public/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen propiedad" class="imagen-tabla">
        </div>

        <div class="texto-entrada">
            <a href="/entrada?id=<?php echo $entrada->id; ?>">
                <h4><?php echo $entrada->titulo; ?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> por: <span>Admin</span> </p>

                <p><?php echo $entrada->resumen ?></p>
            </a>
        </div>
    </article>
<?php endforeach; ?>