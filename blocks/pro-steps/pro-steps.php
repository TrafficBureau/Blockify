<?php

$steps = get_field('pro_steps');
$color = get_field('pro_steps_color') ?: '#e6e6e6';
$background_color = get_field('pro_steps_background_color') ?: '#efefef';

$anchor = '';

if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$class_name = 'pro-block-steps';

if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

?>

<style>
    :root {
        --pro-steps-text-color: <?= $color ?> ;
        --pro-steps-background-color: <?= $background_color ?>;
    }
</style>

<section <?php echo $anchor; // phpcs:ignore ?> class="<?php echo esc_attr($class_name); ?>">
    <?php foreach ($steps as $key => $step) :
        ++$key;
    ?>
        <div class="pro-block-step <?php echo $key % 2 === 0 ? 'align-right' : 'align-left'; ?>">
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
                        src="<?php echo $step['image']['url'] ?>"
                        alt="Pro Step Image"
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
