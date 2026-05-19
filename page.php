
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



<section class="onsite-health">
  <div class="onsite-health__container">

    <h2 class="onsite-health__title">Educación Presencial en Salud</h2>

    <div class="onsite-health__hero">
      <div class="onsite-health__content">
        <p class="onsite-health__text text-left">
          Los ciclos de mejora en una organización se dan siempre acompañados de un óptimo desarrollo profesional continuo, descarga la Solicitud de Capacitación de Educación Presencial en Salud.
        </p>

        <a class="onsite-health__button" href="#">
          Ver catálogo de cursos
        </a>
      </div>

      <figure class="onsite-health__figure">
        <img
          class="onsite-health__image"
          src="<?php echo esc_url( 'http://localhost:8888/cat/wp/wp-content/uploads/2026/05/educacion-presencial-en-salud-imss.png' ); ?>"
          alt="Personal médico revisando información en una tableta"
        >
      </figure>

      <div class="onsite-health__downloads">
        <a class="onsite-health-card" href="#" download>
          <span class="onsite-health-card__icon" aria-hidden="true">
            <i class="fa-regular fa-file-lines"></i>
          </span>

          <span class="onsite-health-card__text">
            Solicitud de Capacitación de Educación Presencial en Salud
          </span>

          <span class="onsite-health-card__download" aria-hidden="true">
            <i class="fa-solid fa-arrow-down"></i>
          </span>
        </a>

        <a class="onsite-health-card" href="#" download>
          <span class="onsite-health-card__icon" aria-hidden="true">
            <i class="fa-regular fa-file-lines"></i>
          </span>

          <span class="onsite-health-card__text">
            Encuesta de satisfacción de cursos Educación Presencial en salud
          </span>

          <span class="onsite-health-card__download" aria-hidden="true">
            <i class="fa-solid fa-arrow-down"></i>
          </span>
        </a>
      </div>
    </div>

    <article class="onsite-health__info">
      <h3 class="onsite-health__subtitle">
        Capacitación para personal extrainstitucional
      </h3>

      <p>
        En el IMSS, la Coordinación de Educación en Salud (CES) es la única instancia normativa facultada para autorizar el ingreso de personal externo, y realicen actividades académico-asistenciales en las unidades médicas en los tres niveles de atención y en las Unidades Médicas de Alta Especialidad.
      </p>

      <p>
        Para ello el personal designado por la CES recibe las solicitudes del personal extrainstitucional que desea capacitarse en el IMSS a través de cursos presenciales de Alta Especialización, Adiestramientos en el Trabajo y Temáticos con Prácticas, que se implementan en las unidades médicas.
      </p>

      <p class="onsite-health__contact">
        Conmutador: 23333i3. Ext 290, 909
      </p>
    </article>

  </div>
</section>





<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('footer.php'); ?>
