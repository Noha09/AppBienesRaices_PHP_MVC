<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if ($mensaje) : ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <img loading="lazy" src="/public/build/img/destacada3.jpg" alt="Imagen Contacto">

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" method="post">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" require>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" require></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select id="opciones" name="contacto[tipo]" require>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[presupuesto]" require>

        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" require>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" require>
            </div>

            <div id="contacto"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>