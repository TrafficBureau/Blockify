<?php

$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_image = get_field('hero_image')
    ? get_field('hero_image')['url']
    : blockify_get_file_url('/blocks/hero/hero.png');
$hero_color = get_field('hero_color') ?: '#ededed';

?>

<style>
    :root {
        --blockify-hero-background-color-v2: <?= $hero_color ?>;
    }
</style>

<div class="blockify-hero">
    <header class="heading">
        <div class="title">
            <?= $hero_title ?>
        </div>
        <p class="subtitle">
            <?= $hero_subtitle ?>
        </p>
    </header>
    <div class="hero-image">
        <img src="<?= $hero_image ?>" alt="hero">
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
                        <div class="title"><?= esc_html($title) ?></div>
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
