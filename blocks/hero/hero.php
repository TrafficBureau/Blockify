<?php

$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_image = get_field('hero_image');

$src = !empty($hero_image['url']) ? $hero_image['url'] : blockify_get_file_url('/blocks/hero/hero.png');

?>


<div class="blockify-hero">
    <header class="heading">
        <h2 class="title">
            <?= $hero_title ?>
        </h2>
        <p class="subtitle">
            <?= $hero_subtitle ?>
        </p>
    </header>
    <div class="hero-image">
        <img src="<?= $src ?>" alt="hero">
    </div>
    <div class="cards js-blockify-cards">
        <?php

        if (have_rows('hero_cards')):
            while (have_rows('hero_cards')) : the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $text  = get_sub_field('text');
                ?>

                <div class="card js-blockify-card">

                    <?php if ($image) : ?>
                        <img src="<?= esc_url($image['url']) ?>" alt="">
                    <?php endif; ?>

                    <div class="content">
                        <h3 class="title"><?= esc_html($title) ?></h3>
                        <div class="text">
                            <?= wp_kses_post($text) ?>
                        </div>
                    </div>

                </div>

                <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
