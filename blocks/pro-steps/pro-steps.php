<?php

use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

global $blockify_current_block;
$blockify_current_block = $block ?? null;

$steps               = Options::getFieldWithDefaults(Options::STEPS);
$number_color        = Options::getFieldWithDefaults(Options::NUMBER_COLOR);
$background_color    = Options::getFieldWithDefaults(Options::BACKGROUND_COLOR );
$color_for_gradient  = Options::getFieldWithDefaults(Options::COLOR_FOR_GRADIENT);
$line_color          = Options::getFieldWithDefaults(Options::LINE_COLOR);

$is_even_steps = count($steps) % 2 === 0;
$anchor        = !empty($block['anchor']) ? 'id="' . esc_attr($block['anchor']) . '" ' : '';
$class_name    = 'pro-block-steps' . (!empty($block['className']) ? ' ' . $block['className'] : '');

?><style>
    :root {
        --pro-steps-number-color: <?= $number_color ?> ;
        --pro-steps-background-color: <?= $background_color ?>;
        --pro-color-for-gradient: <?= $color_for_gradient ?>;
    }
</style><section <?= $anchor; // phpcs:ignore ?> class="<?= esc_attr($class_name); ?>" itemscope itemtype="https://schema.org/HowTo">
    <meta itemprop="name" content="" id="howto-block-name-meta">
    <ol>
        <?php foreach ($steps as $key => $step) :
            ++$key;
            $is_last = $key === count($steps) - 1;
            $is_even = $key % 2 === 0;
            ?>
            <li class="pro-block-step <?= $is_even ? 'align-right' : 'align-left'; ?>" itemscope itemtype="https://schema.org/HowToStep" itemprop="step">
                <meta itemprop="position" content="<?= $key ?>">
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
                            itemprop="image"
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
                    <?php if (!$is_even) : ?>
                        <svg
                            class="pro-block-step__line <?= $is_last && $is_even_steps ? 'half-line' : ''; ?>"
                            width="606"
                            height="691"
                            viewBox="0 0 606 691"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M123.772 2C-234.004 268.207 287.9 91.6696 519.661 323.251C760.42 563.825 436.219 624.265 166.805 689"
                                stroke="<?= $line_color ?>"
                                stroke-width="3"
                                stroke-dasharray="12 12"
                            />
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="pro-block-step__content">
                    <div class="pro-block-step__title" itemprop="name">
                        <?= $step['title'] ?>
                    </div>
                    <div class="pro-block-step__text" itemprop="text">
                        <?= $step['text'] ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<script>
    (function() {
        const section = document.querySelector('.pro-block-steps[itemtype="https://schema.org/HowTo"]');

        if (!section) {
            return;
        }

        let node = section.previousElementSibling;
        let found = '';

        while(node && !found) {
            if (node.matches && (node.matches('h2') || node.matches('h3') || node.matches('h4'))) {
                found = node.textContent.trim();
            }
            node = node.previousElementSibling;
        }

        if (found) {
            document.getElementById('howto-block-name-meta').setAttribute('content', found);
        }
    })();
</script>

<?php $blockify_current_block = null; ?>
