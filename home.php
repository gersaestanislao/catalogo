
<?php
/**
 * Template Name: Plantilla home
 *
 * Este archivo define una plantilla de página en WordPress que carga componentes
 * dinámicamente según la estructura flexible de campos definidos con ACF (Advanced Custom Fields).
 */

// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
?>



<?php 
// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
include('header.php'); ?>

<?php 
// =======================
// NAVBAR
// =======================
get_template_part('components/navbar'); 
?>



<div class="container mt-5">

    <?php 
    // =======================
    // BUSCADOR
    // =======================
    get_template_part('components/buscador'); 
    ?>
</div>


<?php 
// =======================
// CARRUSEL HERO
// =======================
get_template_part('layout/carrusel'); 
?>

<?php 
// =======================
// ACCESOS POR PERFIL
// =======================
get_template_part('layout/feature-perfil'); 
?>

<?php 
// =======================
// CARRUSEL CURSOS EDIMSS
// =======================
get_template_part('layout/cursos_home'); 
?>


<?php 
// =======================
// CARRUSEL MICRO
// =======================
get_template_part('layout/cursos_home--micro'); 
?>


<?php 
// =======================
// MAIN
// =======================
get_template_part('layout/main'); 
?>

<?php 
// =======================
// FEATURE
// =======================
get_template_part('layout/feature'); 
?>



<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('footer.php'); ?>
