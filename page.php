
<?php
/**
 * Template Name: Plantilla interna
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


  <div class="onsite-health__container">


  <?php if (have_rows('modulos_plantilla_interna')) : ?>

    <?php while (have_rows('modulos_plantilla_interna')) : the_row(); ?>

         <!--Módulo Hero interna  -->
        <?php if (get_row_layout() === 'educacion_presencial_salud') : ?>

          <?php 
          // =======================
          // Hero
          // =======================
          get_template_part('page-parts/hero'); 
          ?>

          <!--Bloque informativo -->
          <?php elseif (get_row_layout() === 'bloque_informativo') : ?>

          <?php 
          // =======================
          // Bloque informativo
          // =======================
          get_template_part('page-parts/bloque-informativo'); 
          ?>

          <!--Dos Bloque informativo -->
          <?php elseif (get_row_layout() === 'principales_actividades') : ?>

          <?php 
          // =======================
          //Dos Bloque informativo
          // =======================
          get_template_part('page-parts/dos-bloques-informativos'); 
          ?>

          <!--Oferta educativba -->
          <?php elseif (get_row_layout() === 'oferta_educativa') : ?>

          <?php 
          // =======================
          //Oferta educatica
          // =======================
          get_template_part('page-parts/oferta-educativa'); 
          ?>

          




    <?php endif; ?>

  <?php endwhile; ?>

<?php endif; ?>

</div>


<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('footer.php'); ?>
