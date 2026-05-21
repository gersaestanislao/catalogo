<div class="catalogo__full form-inline">
       <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
              <div class="form-group"> 
                     <input type="search"
                     name="s"
                     class="catalogo__input form-control"
                     placeholder="Busca algun tema ..."
                     value="<?php echo get_search_query(); ?>">


                     
                     <!-- Limitar a tus CPT -->
                     <input type="hidden" name="post_type[]" value="cursos_edmiss">
                     <input type="hidden" name="post_type[]" value="microlecciones">

                     <!-- Opcional: mantener filtros -->
                     <?php if(!empty($_GET['estado'])) : ?>
                            <input type="hidden" name="estado" value="<?php echo esc_attr($_GET['estado']); ?>">
                     <?php endif; ?>

                     <button type="submit" class="catalogo__btn-search  btn boton boton--primario">
                     <i class="fa-brands fa-sistrix"></i>
                     
              </button>
              </div>
       </form>
</div>



