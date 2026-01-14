<?php

use TrafficBureau\Blockify\Admin\Nonce;

if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    exit;
}

$HERO          = 'hero';
$PRO_STEPS     = 'pro-steps';
$RELINKING_TAB = 'relinking-block';

$active_tab  = $_GET['tab'] ?? $HERO;

function href($tab): string {
    return '?page=blockify&tab=' . $tab;
}

function active($active_tab, $tab): string {
    return $active_tab === $tab ? 'nav-tab-active' : '';
}

?>

<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= esc_html(get_admin_page_title()); ?>
        <span class="title-count theme-count"><?= esc_html($GLOBALS['blockify_version']); ?></span>
    </h1>

    <h2 class="nav-tab-wrapper">
        <a
            href="<?= href($HERO); ?>"
            class="nav-tab <?= active($active_tab, $HERO); ?>"
        >Hero</a>
        <a
            href="<?= href($PRO_STEPS); ?>"
            class="nav-tab <?= active($active_tab, $PRO_STEPS); ?>"
        >Pro Steps</a>
        <a
            href="<?= href($RELINKING_TAB); ?>"
            class="nav-tab <?= active($active_tab, $RELINKING_TAB); ?>"
        >Relinking Block</a>
    </h2>

    <form method="post">
        <?php

        if ($active_tab === $HERO) {

            wp_nonce_field(Nonce::HERO_SETTINGS, Nonce::HERO_SETTINGS);
            blockify_include('/admin/templates/tabs/hero.php');
            submit_button('Зберегти');

        } else if ($active_tab === $PRO_STEPS) {

            wp_nonce_field(Nonce::PRO_STEPS, Nonce::PRO_STEPS);
            blockify_include('/admin/templates/tabs/pro-steps.php');
            submit_button('Зберегти');

        } else if ($active_tab === $RELINKING_TAB) {

            wp_nonce_field(Nonce::RELINKING_BLOCK, Nonce::RELINKING_BLOCK);
            blockify_include('/admin/templates/tabs/relinking-block.php');
            submit_button('Зберегти');

        } else {

            echo '<p>Невідома вкладка</p>';

        }

        ?>
    </form>
</div>
