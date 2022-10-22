<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php if($mensaje): ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>
    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" name="contacto[nombre]" id="nombre" placeholder="Tu nombre" required>

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje" placeholder="Escribe tu mensaje aqui" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o compra:</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto:</label>
            <input type="tel" name="contacto[precio]" id="presupuesto" placeholder="Tu Precio o Presupuesto" required>
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required>
            </div>

            <!-- Esto lo lleno desde JS -->
            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>