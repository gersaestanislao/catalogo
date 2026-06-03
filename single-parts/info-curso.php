<div class="course-info">

    <h4 class="course-info__title">
        <i class="course-info__icon fa-regular fa-user" aria-hidden="true"></i>    
        Perfiles
    </h4>

    <?php 
    $template = get_template_directory() . '/components/moduls/taxonomias-perfiles.php';
    if (file_exists($template)) include $template;
    ?>

    <div class="course-info__grid">

        <?php if(!empty($iniciopreregistro)) : ?>
        <div class="course-info__item">
            <p class="course-info__label">
                <i class="course-info__icon fa-regular fa-calendar" aria-hidden="true"></i>
                Inscripciones
            </p>
            <p class="course-info__date">Del <?php echo esc_html($iniciopreregistro); ?> al <?php echo esc_html($finpreregistro); ?></p>
        </div>
        <?php endif; ?>

        <?php if(!empty($fchinic)) : ?>
        <div class="course-info__item">
            <p class="course-info__label">
                <i class="course-info__icon fa-regular fa-calendar" aria-hidden="true"></i>
                Inicio de curso
            </p>
       
            <p class="course-info__date">Del <?php echo esc_html($fchinic); ?> al <?php echo esc_html($fchfin); ?></p>
        </div>
        <?php endif; ?>

        <?php if(!empty($horas)) : ?>
        <div class="course-info__item">
            <p class="course-info__label">
                <i class="course-info__icon fa-regular fa-clock" aria-hidden="true"></i>
                Horas lectivas
            </p>
            <p class="course-info__date"><?php echo esc_html($horas); ?>hr.</p>
        </div>
        <?php endif; ?>

    </div>

    <?php if(!empty($tipo_formacion)) : ?>
         <div class="course-info__item mt-3">
        <p class="course-info__label">
            <i class="course-info__icon fa-regular fa-bookmark" aria-hidden="true"></i>
            Tipo de programa
        </p>
        <p class="course-info__date"><?php echo esc_html($tipo_formacion); ?></p>
    </div>
    <?php endif; ?>

</div>