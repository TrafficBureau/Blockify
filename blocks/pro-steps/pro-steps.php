<?php
/**
 * AFC Gutenberg block: Steps.
 *
 * @var array $block
 */

$steps = get_field('pro-block-steps');
$anchor = '';

if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$class_name = 'pro-block-steps';

if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
?>
<section <?php echo $anchor; // phpcs:ignore ?> class="<?php echo esc_attr($class_name); ?>">
    <?php foreach ($steps as $key => $step) :
        ++$key;
    ?>
        <div class="pro-block-step <?php echo $key % 2 === 0 ? 'align-right' : 'align-left'; ?>">
            <div class="pro-block-step__media">
                <img
                    src="<?php echo $step['image'] ?>"
                    alt=""
                    class="pro-block-step__img"
                    width="222"
                    height="436"
                >

                <div class="pro-block-step__counter">
                    <?php echo str_pad($key, 2, '0', STR_PAD_LEFT); ?>
                </div>
            </div>
            <div class="pro-block-step__content">
                <?php
                if ($step['title']) {
                    echo '<div class="pro-block-step__title">' . $step['title'] . '</div>';
                }

                if ($step['text']) {
                    echo '<div class="pro-block-step__text">' . $step['text'] . '</div>';
                }
                ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
