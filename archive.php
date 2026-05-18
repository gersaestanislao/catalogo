
<?php 
// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
include('header.php'); ?>

<?php 
    // =======================
    // CABECERA GLOBAL DEL SITIO
    // =======================
    include('components/navbar.php'); ?>




  <!-- Inicio del catálogo  -->
  <section class="catalogo mt-5">

    <div class="catalogo__container">

  
      <div class="catalogo__header">

      <?php
          $post_type = get_query_var('post_type');

          if (is_array($post_type)) {
              $post_type = reset($post_type);
          }

          if (empty($post_type)) {
              $queried_object = get_queried_object();
              $post_type = $queried_object->name ?? '';
          }

          $config = [
              'cursos_edmiss' => [
                  'title'   => 'Catálogo de cursos en línea',
                  'archive' => get_post_type_archive_link('cursos_edmiss')
              ],
              'microlecciones' => [
                  'title'   => 'Catálogo de Microlecciones',
                  'archive' => get_post_type_archive_link('microlecciones')
              ]
          ];

          $current = $config[$post_type] ?? [
              'title'   => 'Catálogo',
              'archive' => home_url('/')
          ];
          ?>

          <h1 class="text-left"><?php echo esc_html($current['title']); ?></h1>

          <!-- Buscador WP -->
          <?php include('components/buscador.php'); ?>

        </div>


        <hr class="red">

        
        <form method="GET"
              action="<?php echo esc_url($current['archive']); ?>"
              class="catalogo__form catalogo__layout">

            <!-- Filtros -->
            <?php include('components/filtros.php'); ?>

            <!-- Contenido -->
            <div class="catalogo__content">

                <!-- filtros activos -->
                <?php include('components/filtros-activos.php'); ?>

                <!-- cards -->
                <?php include('components/card.php'); ?>

            </div><!-- /.catalogo__content -->

        </form>

        <!-- Loader -->
        <div id="loader-filtros"
            class="loader-filtros"
            aria-hidden="true">

            <div class="loader-filtros__spinner"></div>

        </div>

    </div>

  </section>





<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('footer.php'); ?>
