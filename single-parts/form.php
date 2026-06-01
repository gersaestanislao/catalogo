<div 
  class="course-form course-form--abierto" 
  id="course-form"
>
    <!-- Título  -->
    <h4 class="course-form__title">
      <?= $esta_abierto ? 'Inscríbete ahora' : 'Sin inscripciones actualmente'; ?>
    </h4>

    <!-- Formulario  -->
    <?php include get_template_directory() . '/single-parts/inputs.php'; ?>


   <!-- /// Botón de agendar -->
    <?php include get_template_directory() . '/single-parts/btn-agenda.php'; ?>

</div>
