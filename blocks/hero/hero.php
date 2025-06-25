<?php

use TrafficBureau\Blockify\Hero\Options;

if (!defined('ABSPATH')) {
    exit;
}

global $blockify_current_block;
$blockify_current_block = $block ?? null;

$title               = Options::getFieldWithDefaults(Options::TITLE);
$subtitle            = Options::getFieldWithDefaults(Options::SUBTITLE);
$title_color         = Options::getFieldWithDefaults(Options::TITLE_COLOR);
$subtitle_color      = Options::getFieldWithDefaults(Options::SUBTITLE_COLOR);
$background_color    = Options::getFieldWithDefaults(Options::BACKGROUND_COLOR);
$is_enabled_gradient = Options::getFieldWithDefaults(Options::IS_ENABLED_GRADIENT);
$color_for_gradient  = Options::getFieldWithDefaults(Options::COLOR_FOR_GRADIENT);
$hero_image_id       = Options::getFieldWithDefaults(Options::HERO_IMAGE_ID);
$hero_image_top      = Options::getFieldWithDefaults(Options::HERO_IMAGE_TOP);
$hero_image_right    = Options::getFieldWithDefaults(Options::HERO_IMAGE_RIGHT);
$hero_image_field    = get_field(Options::HERO_IMAGE);
$hero_image_alt      = $hero_image_field['alt'] ?? null;
$hero_image_url      = $hero_image_field['url'] ?? null;
$use_global          = get_field(Options::USE_GLOBAL_OPTIONS);

if ($use_global && !empty($hero_image_id)) {
    $hero_image_url = wp_get_attachment_image_url($hero_image_id, 'full');
    $hero_image_alt = get_post_meta($hero_image_id, '_wp_attachment_image_alt', true) ?: null;
} elseif (empty($hero_image_url) && !empty($hero_image_id)) {
    $hero_image_url = wp_get_attachment_image_url($hero_image_id, 'full');
    $hero_image_alt = get_post_meta($hero_image_id, '_wp_attachment_image_alt', true) ?: null;
}

if ($hero_image_alt === null) {
    $hero_image_alt = 'hero';
}

if (empty($hero_image_url)) {
    $hero_image_url = blockify_get_file_url('/blocks/hero/hero.png');
}

?><style>
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
</style><div class="blockify-hero">
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

<?php $blockify_current_block = null; ?>
