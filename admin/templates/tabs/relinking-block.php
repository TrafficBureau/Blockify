<?php

use TrafficBureau\Blockify\Relinking\Options;

if (!defined('ABSPATH')) {
    exit;
}

$background_color  = get_option(Options::BACKGROUND_COLOR, Options::DEFAULTS[Options::BACKGROUND_COLOR]);
$text_color        = get_option(Options::TEXT_COLOR, Options::DEFAULTS[Options::TEXT_COLOR]);
$title_color       = get_option(Options::TITLE_COLOR, Options::DEFAULTS[Options::TITLE_COLOR]);
$button_bg_color   = get_option(Options::BUTTON_BG_COLOR, Options::DEFAULTS[Options::BUTTON_BG_COLOR]);
$icon_color        = get_option(Options::ICON_COLOR, Options::DEFAULTS[Options::ICON_COLOR]);

?>

<p class="description" style="margin-top: 20px;">
    На цій сторінці можна встановити стандартні значення для Relinking Block
</p>

<table class="form-table">
    <tr>
        <th scope="row">
            <label for="<?= Options::BACKGROUND_COLOR ?>">Колір фону:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::BACKGROUND_COLOR ?>"
                name="<?= Options::BACKGROUND_COLOR ?>"
                value="<?= esc_attr($background_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::BACKGROUND_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::TITLE_COLOR ?>">Колір заголовка:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::TITLE_COLOR ?>"
                name="<?= Options::TITLE_COLOR ?>"
                value="<?= esc_attr($title_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::TITLE_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::TEXT_COLOR ?>">Колір тексту:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::TEXT_COLOR ?>"
                name="<?= Options::TEXT_COLOR ?>"
                value="<?= esc_attr($text_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::TEXT_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::BUTTON_BG_COLOR ?>">Колір кнопки:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::BUTTON_BG_COLOR ?>"
                name="<?= Options::BUTTON_BG_COLOR ?>"
                value="<?= esc_attr($button_bg_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::BUTTON_BG_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::ICON_COLOR ?>">Колір іконки:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::ICON_COLOR ?>"
                name="<?= Options::ICON_COLOR ?>"
                value="<?= esc_attr($icon_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::ICON_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="reset-relinking-settings">Скинути на стандартні налаштування:</label>
        </th>
        <td>
            <button
                type="button"
                class="button button-secondary"
                id="reset-relinking-settings"
            >Скинути</button>
            <p class="description">Після скидання необхідно зберегти зміни, щоб застосувати стандартні значення</p>
        </td>
    </tr>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('reset-relinking-settings').addEventListener('click', function() {
            resetRelinkingSettings();
        });
    });

    function resetRelinkingSettings() {
        document.querySelectorAll('[data-default]').forEach(function(input) {
            if (input.type === 'checkbox') {
                input.checked = input.getAttribute('data-default') === '1';
            } else {
                input.value = input.getAttribute('data-default');
            }
        });
    }
</script>
