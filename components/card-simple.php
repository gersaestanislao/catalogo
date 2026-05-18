  <!-- Texto  -->
  <div class='curso-card__body'>


<!-- Título  -->
<h4 class='curso-card__title'>  <?php the_title(); ?></h4> 
<small> Perfíles: </small>

 <!-- Perfiles  -->
<?php
    $terms = [];

    if($post_type === 'cursos_edmiss'){
        $terms = $perfiles;
    }

    if($post_type === 'microlecciones'){
        $terms = $temas;
    }
    ?>

    <?php if($terms) : ?>
        <div class="curso-card__<?php echo esc_html($term->slug); ?>">
            <div class="curso-card__tags-content">
                <?php foreach($terms as $term) : ?>
                    <span class="curso-card__tag curso-card__tag--<?php echo esc_html($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</div> <!--// Texto  -->