<?php

use TrafficBureau\Blockify\Hero\Options;

if (!defined('ABSPATH')) {
    exit;
}

function get_field_with_defaults(string $field_name) {
    return blockify_get_field($field_name, Options::DEFAULTS);
}

$title               = get_field_with_defaults(Options::TITLE);
$subtitle            = get_field_with_defaults(Options::SUBTITLE);
$title_color         = get_field_with_defaults(Options::TITLE_COLOR);
$subtitle_color      = get_field_with_defaults(Options::SUBTITLE_COLOR);
$background_color    = get_field_with_defaults(Options::BACKGROUND_COLOR);
$is_enabled_gradient = get_field_with_defaults(Options::IS_ENABLED_GRADIENT);
$color_for_gradient  = get_field_with_defaults(Options::COLOR_FOR_GRADIENT);
$hero_image_id       = get_field_with_defaults(Options::HERO_IMAGE_ID);
$hero_image_top      = get_field_with_defaults(Options::HERO_IMAGE_TOP);
$hero_image_right    = get_field_with_defaults(Options::HERO_IMAGE_RIGHT);
$hero_image_field    = get_field(Options::HERO_IMAGE);
$hero_image_alt      = $hero_image_field['alt'] ?? 'hero';
$hero_image_url      = $hero_image_field['url'] ?? null;

if (empty($hero_image_url) && !empty($hero_image_id)) {
    $hero_image_url = wp_get_attachment_image_url($hero_image_id, 'medium');
}

if (empty($hero_image_url)) {
    $hero_image_url = blockify_get_file_url('/blocks/hero/hero.png');
}

?>

<style>
    :root {
        --blockify-hero-title-color: <?= $title_color ?>;
        --blockify-hero-subtitle-color: <?= $subtitle_color ?>;
        --blockify-hero-background-color: <?= $background_color ?>;
        --blockify-hero-background-color-for-gradient: <?= $color_for_gradient ?>;
        --blockify-hero-image-top: <?= $hero_image_top ?>px;
        --blockify-hero-image-right: <?= $hero_image_right ?>px;
    }

    <?php if ($is_enabled_gradient) : ?>
        .blockify-hero {
            background-image: linear-gradient(
                180deg,
                var(--blockify-hero-background-color),
                var(--blockify-hero-background-color-for-gradient)
            );
        }
    <?php endif; ?>
</style>

<div class="blockify-hero">
    <header class="heading">
        <div class="title">
            <?= esc_html($title) ?>
        </div>
        <?php if ($subtitle) : ?>
            <div class="subtitle">
                <?= esc_html($subtitle) ?>
            </div>
        <?php endif; ?>
    </header>
    <div class="hero-image">
        <img
            src="<?= esc_url($hero_image_url) ?>"
            alt="<?= esc_attr($hero_image_alt) ?>"
        />
    </div>
    <ul class="cards js-blockify-cards">
        <?php

        if (have_rows('hero_cards')):
            while (have_rows('hero_cards')) :
                the_row();
                $image = get_sub_field('image');
                $title = get_sub_field('title');
                $text  = get_sub_field('text');
                ?>
                <li class="card js-blockify-card">

                    <?php if ($image) : ?>
                        <figure class="image">
                            <img
                                src="<?= esc_url($image['url']) ?>"
                                alt="<?= esc_attr($image['alt']) ?>"
                            />
                        </figure>
                    <?php endif; ?>

                    <div class="content">
                        <?php if ($title) : ?>
                            <div class="title">
                                <?= esc_html($title) ?>
                            </div>
                        <?php endif; ?>
                        <div class="text">
                            <?= wp_kses_post($text) ?>
                        </div>
                    </div>

                </li>
                <?php
            endwhile;
        endif;
        ?>
    </ul>
</div>
