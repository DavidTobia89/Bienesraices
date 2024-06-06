
<?php
require 'includes/funciones.php';

incluirTemplate('header');

?>

    <main class="contenedor seccion">
       
            <h2> Casas y Depas en Venta</h2>
            <?php
             $limite = 12;
            include 'includes/templates/anuncios.php';
            ?>
            </div>
        
    </main>
    <?php

incluirTemplate('footer');

?>
