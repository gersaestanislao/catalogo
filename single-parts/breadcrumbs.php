<?php
$post_type = get_post_type();
$link = get_post_type_archive_link($post_type);
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <i class="fa-regular fa-house"></i>    
            </a>
        </li>

        <?php if ($link): ?>
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url($link); ?>">
                    Catálogo
                </a>
            </li>
        <?php endif; ?>

        <li class="breadcrumb-item active" aria-current="page">
            <?php echo esc_html(wp_trim_words(get_the_title(), 3, '…')); ?>
        </li>
    </ol>
</nav>
