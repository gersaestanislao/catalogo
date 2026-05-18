<?php 
$main = get_field('home_main'); 
?>

<?php if ($main) : 

    $logo   = $main['logo'] ?? null;
    $titulo = $main['titulo'] ?? '';
    $desc   = $main['descripcion'] ?? '';
    $btn    = $main['texto_boton'] ?? '';
    $url    = $main['url_boton'] ?? '';

    $alt = $logo['alt'] ?? $titulo;
?>

<section class="main">
    <div class="container text-center">
        <div class="col">

            <?php if ($logo): ?>
                <img 
                    class="main__logo" 
                    src="<?php echo esc_url($logo['url']); ?>" 
                    alt="<?php echo esc_attr($alt); ?>">
            <?php endif; ?>
            
            <?php if ($titulo): ?>
                <h4 class="mt-5 mb-5">
                    <?php echo esc_html($titulo); ?>
                </h4>
            <?php endif; ?>

            <?php if ($desc): ?>
                <p class="main__descript">
                    <?php echo esc_html($desc); ?>
                </p>
            <?php endif; ?>

            <?php if ($btn && $url): ?>
                <p class="text-center mt-5"> 
                    <a href="<?php echo esc_url($url); ?>" 
                       class="boton boton--link boton--icon">
                        <?php echo esc_html($btn); ?>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </p>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php endif; ?>