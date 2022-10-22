<?php
/* Incluir la conexion☻ */
// $db = conectarDB();

/* Consultar */
// $query = "SELECT * FROM propiedades LIMIT ${limite}";

/* Obtener resultados */
// $resultado = mysqli_query($db, $query);

use App\Propiedad;


if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}

?>

<div class="contenedor-anuncios">
    <!-- <php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?> -->
    <?php foreach($propiedades as $propiedad) : ?>
        <div class="anuncios">
            <!-- <img loading="lazy" src="/imagenes/<php echo $propiedad['imagen']; ?>" alt="Anuncio"> -->
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio">
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono-svg" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono-svg" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img class="icono-svg" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitacion">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>
                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedades</a>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- <php endwhile; ?> -->
</div>

<!-- <php mysqli_close($db); ?> en active record tenemos el free(); -->