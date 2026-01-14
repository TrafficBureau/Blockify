<?php

use TrafficBureau\Blockify\Relinking\Options;

if (!defined('ABSPATH')) {
    exit;
}

$anchor     = !empty($block['anchor']) ? esc_attr($block['anchor']) : 'relinking-block-' . uniqid();
$items      = get_field('relinking_items') ?: [];
$columns    = (int) get_field('relinking_columns');
$columns    = $columns >= 1 && $columns <= 8 ? $columns : 3;
$items_type = get_field('relinking_items_type') ?: 'icon';
$class_name = 'blockify-relinking-card' . (!empty($block['className']) ? ' ' . $block['className'] : '');

$use_global       = get_field(Options::USE_GLOBAL_OPTIONS);
$background_color = Options::getFieldWithDefaults(Options::BACKGROUND_COLOR);
$text_color       = Options::getFieldWithDefaults(Options::TEXT_COLOR);
$title_color      = Options::getFieldWithDefaults(Options::TITLE_COLOR);
$button_bg_color  = Options::getFieldWithDefaults(Options::BUTTON_BG_COLOR);
$icon_color       = Options::getFieldWithDefaults(Options::ICON_COLOR);
$section_style    = '--blockify-relinking-columns: ' . $columns . ';';

$style = '';
if (!$use_global) {
    $style = '--blockify-relinking-bg-color: ' . $background_color .
        '; --blockify-relinking-text-color: ' . $text_color .
        '; --blockify-relinking-title-color: ' . $title_color .
        '; --blockify-relinking-button-bg-color: ' . $button_bg_color .
        '; --blockify-relinking-icon-color: ' . $icon_color . ';';
}

$allowed_svg = [
    'svg' => [
        'xmlns' => true,
        'viewbox' => true,
        'viewBox' => true,
        'width' => true,
        'height' => true,
        'preserveAspectRatio' => true,
        'fill' => true,
        'stroke' => true,
        'class' => true,
        'style' => true,
        'aria-hidden' => true,
        'role' => true,
        'xmlns:xlink' => true,
    ],
    'path' => [
        'd' => true,
        'fill' => true,
        'fill-opacity' => true,
        'stroke' => true,
        'stroke-opacity' => true,
        'stroke-width' => true,
        'stroke-linecap' => true,
        'stroke-linejoin' => true,
        'stroke-miterlimit' => true,
        'stroke-dasharray' => true,
        'stroke-dashoffset' => true,
        'fill-rule' => true,
        'clip-rule' => true,
        'clip-path' => true,
        'opacity' => true,
        'transform' => true,
        'style' => true,
    ],
    'circle' => [
        'cx' => true,
        'cy' => true,
        'r' => true,
        'fill' => true,
        'stroke' => true,
        'stroke-width' => true,
        'opacity' => true,
        'transform' => true,
    ],
    'rect' => [
        'x' => true,
        'y' => true,
        'width' => true,
        'height' => true,
        'rx' => true,
        'ry' => true,
        'fill' => true,
        'stroke' => true,
        'stroke-width' => true,
        'opacity' => true,
        'transform' => true,
    ],
    'ellipse' => [
        'cx' => true,
        'cy' => true,
        'rx' => true,
        'ry' => true,
        'fill' => true,
        'stroke' => true,
        'stroke-width' => true,
        'opacity' => true,
        'transform' => true,
    ],
    'g' => [
        'fill' => true,
        'stroke' => true,
        'transform' => true,
        'clip-path' => true,
        'opacity' => true,
        'style' => true,
    ],
    'line' => [
        'x1' => true,
        'y1' => true,
        'x2' => true,
        'y2' => true,
        'stroke' => true,
        'stroke-width' => true,
    ],
    'polygon' => [
        'points' => true,
        'fill' => true,
        'stroke' => true,
        'stroke-width' => true,
        'opacity' => true,
        'transform' => true,
    ],
    'polyline' => [
        'points' => true,
        'fill' => true,
        'stroke' => true,
        'stroke-width' => true,
        'opacity' => true,
        'transform' => true,
    ],
    'defs' => [],
    'clipPath' => [
        'id' => true,
    ],
    'mask' => [
        'id' => true,
        'x' => true,
        'y' => true,
        'width' => true,
        'height' => true,
        'maskUnits' => true,
    ],
    'linearGradient' => [
        'id' => true,
        'x1' => true,
        'y1' => true,
        'x2' => true,
        'y2' => true,
        'gradientUnits' => true,
    ],
    'radialGradient' => [
        'id' => true,
        'cx' => true,
        'cy' => true,
        'r' => true,
        'fx' => true,
        'fy' => true,
        'gradientUnits' => true,
    ],
    'stop' => [
        'offset' => true,
        'stop-color' => true,
        'stop-opacity' => true,
    ],
    'use' => [
        'href' => true,
        'xlink:href' => true,
        'x' => true,
        'y' => true,
    ],
    'symbol' => [
        'id' => true,
        'viewBox' => true,
    ],
    'pattern' => [
        'id' => true,
        'width' => true,
        'height' => true,
        'patternUnits' => true,
    ],
    'style' => [
        'type' => true,
    ],
    'title' => [],
    'desc' => [],
];

// SVG decoder lives in helpers.php.

?>

<section id="<?= $anchor; // phpcs:ignore ?>" class="blockify-relinking" style="<?= esc_attr($section_style); ?>" aria-label="Relinking Block">
        <?php foreach ($items as $item) :
            $item_title       = $item['relinking_item_title'] ?? '';
            $item_description = $item['relinking_item_description'] ?? '';
            $item_url         = $item['relinking_item_url'] ?? '';
            $item_class       = $class_name . ($items_type === 'image' ? ' blockify-relinking-card--image' : ' blockify-relinking-card--icon');
            ?>

            <?php if ($items_type === 'image') :
                $item_image       = $item['relinking_item_image'] ?? null;
                $item_show_desc   = $item['relinking_item_show_description'] ?? true;
                $item_button_text = $item['relinking_item_button_text'] ?? 'Learn more';
                $item_button_url  = $item['relinking_item_button_url'] ?? '';
                $item_image_alt   = $item_image['alt'] ?? ($item_title ?: 'Image');
                ?>
                <div class="blockify-relinking-item">
                    <article class="<?= esc_attr($item_class); ?>"<?= $style ? ' style="' . esc_attr($style) . '"' : ''; ?>>
                        <div class="blockify-relinking-card-wrap">
                            <?php if (!empty($item_image)) : ?>
                                <figure class="blockify-relinking-card__media">
                                    <img src="<?= esc_url($item_image['url']); ?>" alt="<?= esc_attr($item_image_alt); ?>" loading="lazy" />
                                </figure>
                            <?php endif; ?>
                            <div class="blockify-relinking-card__content">
                                <?php if (!empty($item_title)) : ?>
                                    <span class="blockify-relinking-card__title"><?= esc_html($item_title); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($item_description) && $item_show_desc) : ?>
                                    <span class="blockify-relinking-card__description"><?= wp_kses_post($item_description); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="blockify-relinking-card__footer">
                            <a class="blockify-relinking-card__button" href="<?= esc_url($item_button_url); ?>" rel="noopener" aria-label="<?= esc_attr($item_title ?: $item_button_text); ?>">
                                <?= esc_html($item_button_text); ?>
                            </a>
                        </div>
                    </article>
                </div>
            <?php else :
                $item_svg = $item['relinking_item_svg'] ?? '';
                $item_alt = $item['relinking_item_alt'] ?? ($item_title ?: 'Icon');
                $title_html = '';
                if (!empty($item_title)) {
                    $title_html = '<span class="blockify-relinking-card__title">' . esc_html($item_title) . '</span>';
                }
                $desc_html = '';
                if (!empty($item_description)) {
                    $desc_html = '<span class="blockify-relinking-card__description">' . wp_kses_post($item_description) . '</span>';
                }
                $icon_html = '';
                if (!empty($item_svg)) {
                    $icon_html = '<span class="blockify-relinking-card__icon" role="img" aria-label="' . esc_attr($item_alt) . '">' . wp_kses($item_svg, $allowed_svg) . '</span>';
                }
                ?>
                <div class="blockify-relinking-item">
                    <a class="<?= esc_attr($item_class); ?>" href="<?= esc_url($item_url); ?>" rel="noopener" aria-label="<?= esc_attr($item_title ?: $item_alt); ?>"<?= $style ? ' style="' . esc_attr($style) . '"' : ''; ?>><?= $title_html . $desc_html . $icon_html; ?></a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
</section>
