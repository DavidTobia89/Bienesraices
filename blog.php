
<?php
require 'includes/funciones.php';

incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado ">
       
            <h1>Nuestro Blog</h1>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jgp">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terreza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/05/2024</span> por: <span>Admin</span></p>
                    </a>
                    <p>
                        Consejos para construir una terra en el techo de tu casa con  los materiales y ahorrando dinero
                    </p>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jgp">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guía para la decoración de tu casa</h4>
                        <p>Escrito el: <span>20/05/2024</span> por: <span>Admin</span></p>
                    </a>
                    <p>
                        Maximiza el espacio en tu hogar con esta guía, aprende a combinar colores para darle vida a tu espacio 
                    </p>
                </div>
            </article>
            <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.jpg" type="image/jgp">
                    <img loading="lazy" src="build/img/blog3.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Terreza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/05/2024</span> por: <span>Admin</span></p>
                </a>
                <p>
                    Consejos para construir una terra en el techo de tu casa con  los materiales y ahorrando dinero
                </p>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.jpg" type="image/jgp">
                    <img loading="lazy" src="build/img/blog4.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Guía para la decoración de tu casa</h4>
                    <p>Escrito el: <span>20/05/2024</span> por: <span>Admin</span></p>
                </a>
                <p>
                    Maximiza el espacio en tu hogar con esta guía, aprende a combinar colores para darle vida a tu espacio 
                </p>
            </div>
        </article>
    </main>
    <?php

incluirTemplate('footer');

?>
