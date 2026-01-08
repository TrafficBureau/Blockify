<?php

use TrafficBureau\Blockify\Relinking\Options;

if (!defined('ABSPATH')) {
    exit;
}

$background_color  = get_option(Options::BACKGROUND_COLOR, Options::DEFAULTS[Options::BACKGROUND_COLOR]);
$text_color        = get_option(Options::TEXT_COLOR, Options::DEFAULTS[Options::TEXT_COLOR]);
$link_color        = get_option(Options::LINK_COLOR, Options::DEFAULTS[Options::LINK_COLOR]);
$icon_color        = get_option(Options::ICON_COLOR, Options::DEFAULTS[Options::ICON_COLOR]);
$background_id  = get_option(Options::BACKGROUND_IMAGE_ID, Options::DEFAULTS[Options::BACKGROUND_IMAGE_ID]);
$background_url = $background_id ? wp_get_attachment_image_url($background_id, 'medium') : '';

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
            <label for="<?= Options::BACKGROUND_IMAGE_ID ?>">Фон (зображення):</label>
        </th>
        <td>
            <input
                type="hidden"
                id="<?= Options::BACKGROUND_IMAGE_ID ?>"
                name="<?= Options::BACKGROUND_IMAGE_ID ?>"
                value="<?= esc_attr($background_id); ?>"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::BACKGROUND_IMAGE_ID]) ?>"
            />
            <div id="relinking-background-preview">
                <?php if ($background_url): ?>
                    <img
                        src="<?= esc_url($background_url); ?>"
                        alt="background preview"
                        style="max-width:150px; display:block; margin-bottom:8px;"
                    />
                <?php endif; ?>
            </div>
            <button
                type="button"
                class="button"
                id="select-relinking-background"
            >Обрати зображення</button>
            <button
                type="button"
                class="button"
                id="remove-relinking-background"
                <?= $background_id ? '' : ' style="display:none;"' ?>
            >Видалити</button>
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
            <label for="<?= Options::LINK_COLOR ?>">Колір посилання:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::LINK_COLOR ?>"
                name="<?= Options::LINK_COLOR ?>"
                value="<?= esc_attr($link_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::LINK_COLOR])) ?>"
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
        initRelinkingMediaSelector();
        document.getElementById('reset-relinking-settings').addEventListener('click', function() {
            resetRelinkingSettings();
        });
    });

    function initRelinkingMediaSelector() {
        const selectBtn  = document.getElementById('select-relinking-background');
        const removeBtn  = document.getElementById('remove-relinking-background');
        const imageInput = document.getElementById('<?= Options::BACKGROUND_IMAGE_ID ?>');
        const previewDiv = document.getElementById('relinking-background-preview');

        let frame;

        selectBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Обрати фон для блоку',
                button: {text: 'Обрати'},
                multiple: false
            });
            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                imageInput.value = attachment.id;
                previewDiv.innerHTML = `<img
                    src="${attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url}"
                    style="max-width:150px; display:block; margin-bottom:8px;"
                />`;
                removeBtn.style.display = '';
            });
            frame.open();
        });

        removeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            imageInput.value = '';
            previewDiv.innerHTML = '';
            removeBtn.style.display = 'none';
        });
    }

    function resetRelinkingSettings() {
        document.querySelectorAll('[data-default]').forEach(function(input) {
            if (input.type === 'checkbox') {
                input.checked = input.getAttribute('data-default') === '1';
            } else {
                input.value = input.getAttribute('data-default');
            }
        });
        document.getElementById('relinking-background-preview').innerHTML = '';
        document.getElementById('remove-relinking-background').style.display = 'none';
    }
</script>
