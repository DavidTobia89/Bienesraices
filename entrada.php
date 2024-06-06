<?php
require 'includes/funciones.php';

incluirTemplate('header');

?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Guí para la decoración de tu hofar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jgp">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="anuncio">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20/05/2024</span> por: <span>Admin</span></p>
        <div class="resumen-propiedad">
           
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex nobis assumenda tenetur id doloribus optio adipisci.
                Autem, delectus perferendis quisquam quae at numquam odit unde debitis voluptatem nostrum fugiat porro. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente omnis excepturi nostrum atque iusto maxime quis ut, aut cum dolores, hic aperiam tenetur magni iste quibusdam, optio debitis dolore ipsum?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex nobis assumenda tenetur id doloribus optio adipisci.
                Autem, delectus perferendis quisquam quae at numquam odit unde debitis voluptatem nostrum fugiat porro. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente omnis excepturi nostrum atque iusto maxime quis ut, aut cum dolores, hic aperiam tenetur magni iste quibusdam, optio debitis dolore ipsum?</p>
            </div>
    </main>
    <?php

incluirTemplate('footer');

?>
