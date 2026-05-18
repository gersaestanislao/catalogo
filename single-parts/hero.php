<section class="course-hero">
    
    <div class="course-hero__inner">
        
        <!-- Media  Imagen -->
        <div class="course-hero__media">

            <!-- Imagen -->
            <?php include get_template_directory() . '/components/moduls/media.php'; ?>
          
        </div>

        <!-- Badge -->

        <div class="course-hero__badge">
        
        <span>Inicio de inscripción</span>

            <strong><?php echo esc_html($fecha); ?></strong>

        </div> <!--// Badge -->

        <!-- Sombra-->
        <div class="course-hero__overlay"></div>

        <!-- Contenido -->
        <div class="course-hero__content">

            <!-- Título -->
            <h1 class="course-hero__title">
                <?php the_title(); ?>
            </h1>

            <!-- Perfíles -->
            <?php include get_template_directory() . '/components/moduls/taxonomias-perfiles.php'; ?>


        </div><!--// Contenido -->


    </div>
    
    <!-- Formulario -->
    <?php include get_template_directory() . '/single-parts/form.php'; ?>


</section>