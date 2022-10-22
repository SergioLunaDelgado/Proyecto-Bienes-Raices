<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguirdad" loading="lazy">
            <h3>Seguirdad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum in incidunt reprehenderit ullam
                dolorem similique eligendi tenetur nemo error? Perferendis adipisci doloribus iusto amet a quod
                debitis velit commodi vero.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum in incidunt reprehenderit ullam
                dolorem similique eligendi tenetur nemo error? Perferendis adipisci doloribus iusto amet a quod
                debitis velit commodi vero.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum in incidunt reprehenderit ullam
                dolorem similique eligendi tenetur nemo error? Perferendis adipisci doloribus iusto amet a quod
                debitis velit commodi vero.</p>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>
    <?php
    // $limite = 3;
    include 'listado.php';
    ?>'
    <div class="alinear-derecha">
        <a href="/anuncios" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferiero">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/blog">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>21/7/2022 </span>por: <span>Admin</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y
                        ahorrando dinero.</p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/blog">
                    <h4>Guía para la decoracion de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>21/7/2022 </span>por: <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guía aprende a combinar mueblos y colores para darle
                        vida a tu espacio</p>
                </a>
            </div>
        </article>
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron
                cumple con todas mis expectativas.
            </blockquote>
            <p>- Sergio Luna</p>
        </div>
    </section>
</div>