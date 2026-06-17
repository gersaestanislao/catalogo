<?php
$titulo    = get_sub_field('titulo');
$subtitulo = get_sub_field('subtitulo');

?>

<section class="training-videos">

    <?php if ($titulo || $subtitulo) : ?>

        <h2 class="training-videos__heading">

            <?php if ($titulo) : ?>
                <span class="training-videos__title">
                    <?php echo esc_html($titulo); ?>
                </span>
            <?php endif; ?>

            <?php if ($subtitulo) : ?>
                <span class="training-videos__separator">/</span>

                <span class="training-videos__subtitle">
                    <?php echo esc_html($subtitulo); ?>
                </span>
            <?php endif; ?>

        </h2>

    <?php endif; ?>

    <?php if (have_rows('videos')) : ?>

        <div class="training-videos__grid">

            <?php while (have_rows('videos')) : the_row();

                $video_url = get_sub_field('video_url');
                $video     = get_sub_field('video');
                $poster    = get_sub_field('poster');
                $titulo    = get_sub_field('titulo');

                $src = '';

                if (!empty($video_url)) {
                    $src = $video_url;
                } elseif (!empty($video['url'])) {
                    $src = $video['url'];
                }

                $poster_url = !empty($poster['url']) ? $poster['url'] : '';

            ?>

                <article class="training-videos__card">

                    <?php if (!empty($src)) : ?>

                        <div class="training-videos__media">

                            <video
                                controls
                                preload="metadata"
                                class="training-videos__video"
                                <?php if ($poster_url) : ?>
                                    poster="<?php echo esc_url($poster_url); ?>"
                                <?php endif; ?>
                            >
                                <source
                                    src="<?php echo esc_url($src); ?>"
                                    type="video/mp4"
                                >
                            </video>

                        </div>

                    <?php endif; ?>

                    <?php if ($titulo) : ?>

                        <p class="training-videos__card-title">
                            <?php echo esc_html($titulo); ?>
                    </p>

                    <?php endif; ?>

                </article>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</section>