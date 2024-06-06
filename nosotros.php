
<?php
require 'includes/funciones.php';

incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        
            <div class="contenido-nosotros">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/nosotros.webp" type="image/webp">
                        <source srcset="build/img/nosotros.jpg" type="image/jgp">
                        <img loading="lazy" src="build/img/nosotros.jpg" alt="anuncio">
                    </picture>
                </div>
                
                <div class="texto-nosotros">
                    <blockquote>25 Años de Experiencia</blockquote>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore, animi quae? 
                        Possimus totam eius asperiores exercitationem neque saepe! Optio modi quaerat et
                        exercitationem delectus obcaecati nesciunt molestias corrupti expedita veritatis?</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore, animi quae? 
                        Possimus totam eius asperiores exercitationem neque saepe! Optio modi quaerat et
                        exercitationem delectus obcaecati nesciunt molestias corrupti expedita veritatis?</p>
                </div>
            </div>
    </main>
    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
            </div>
        </div>
    </section>
    <?php

incluirTemplate('footer');

?>
