<?php

use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

$steps               = Options::getFieldWithDefaults(Options::STEPS);
$number_color        = Options::getFieldWithDefaults(Options::NUMBER_COLOR);
$background_color    = Options::getFieldWithDefaults(Options::BACKGROUND_COLOR );
$color_for_gradient  = Options::getFieldWithDefaults(Options::COLOR_FOR_GRADIENT);

$anchor     = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$class_name = 'pro-block-steps' . (!empty($block['className']) ? ' ' . $block['className'] : '');

?>

<style>
    :root {
        --pro-steps-number-color: <?= $number_color ?> ;
        --pro-steps-background-color: <?= $background_color ?>;
        --pro-color-for-gradient: <?= $color_for_gradient ?>;
    }
</style>

<section <?= $anchor; // phpcs:ignore ?> class="<?= esc_attr($class_name); ?>">
    <?php foreach ($steps as $key => $step) :
        ++$key;
        ?>
        <div class="pro-block-step <?= $key % 2 === 0 ? 'align-right' : 'align-left'; ?>">
            <div class="pro-block-step__media">
                <div class="pro-block-step__img-wrapper">
                    <img
                        src="<?= blockify_get_file_url('/blocks/pro-steps/smartphone.png'); ?>"
                        alt="iPhone frame"
                        class="pro-block-step__img-frame"
                        width="222"
                        height="457"
                    >
                    <img
                        src="<?= $step['image']['url'] ?>"
                        alt="<?= esc_attr($step['image']['alt'] ?? 'Step image') ?>"
                        class="pro-block-step__img"
                        width="222"
                        height="457"
                    >
                </div>
                <div class="pro-block-step__counter">
                    <span class="desktop">
                        <?= str_pad($key, 2, '0', STR_PAD_LEFT); ?>
                    </span>
                    <span class="mobile">
                        <?= $key; ?>
                    </span>
                </div>
                <svg class="pro-block-step__line" width="606" height="691" viewBox="0 0 606 691" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M123.772 2C-234.004 268.207 287.9 91.6696 519.661 323.251C760.42 563.825 436.219 624.265 166.805 689"
                        stroke="#cccccc"
                        stroke-width="3"
                        stroke-dasharray="12 12"
                    />
                </svg>
            </div>
            <div class="pro-block-step__content">
                <div class="pro-block-step__title">
                    <?= $step['title'] ?>
                </div>
                <div class="pro-block-step__text">
                    <?= $step['text'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
