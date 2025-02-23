<?php
/**
 * AFC Gutenberg block: Iframe Lazy.
 *
 * @var array $block
 */

if (!defined('ABSPATH')) {
    exit;
}

$iframe = trim(get_field( 'block-iframe-lazy-content' ));
$thumb_url = get_field( 'block-iframe-lazy-thumbnail' );

$iframe = new WP_HTML_Tag_Processor( $iframe );
$iframe->next_tag();
$src = $iframe->get_attribute('src');
$iframe->set_attribute('data-src', $src);
$iframe->remove_attribute('src');
$iframe->add_class('no-lazy wp-iframe-lazy');

$iframe = $iframe->get_updated_html();

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'wp-iframe-lazy-wrapper wpIframeLazyWrapper';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
?>

<?php if ( $iframe ) : ?>
<div <?php echo $anchor; // phpcs:ignore ?> class="<?php echo esc_attr( $class_name ); ?>">
    <div class="wp-iframe-lazy-overlay">
        <button class="wp-iframe-lazy-button" aria-label="Грати">Грати</button>

        <?php if ( $thumb_url ): ?>
            <img
                src="<?php echo esc_url($thumb_url); ?>"
                alt=""
            >
        <?php endif; ?>
    </div>
    <?php echo $iframe; ?>
</div>
<?php endif; ?>
