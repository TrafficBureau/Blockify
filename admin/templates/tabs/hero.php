<?php

use TrafficBureau\Blockify\Hero\Options;

if (!defined('ABSPATH')) {
    exit;
}

$subtitle         = Options::getFieldWithDefaults(Options::SUBTITLE);
$hero_image_id    = Options::getFieldWithDefaults(Options::HERO_IMAGE_ID);
$hero_image_url   = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'medium') : '';
$hero_image_top   = Options::getFieldWithDefaults(Options::HERO_IMAGE_TOP);
$hero_image_right = Options::getFieldWithDefaults(Options::HERO_IMAGE_RIGHT);
$title_color      = Options::getFieldWithDefaults(Options::TITLE_COLOR);

?>

<p class="description" style="margin-top: 20px;">
    На цій сторінці можна встановити стандартні значення для блоку Hero
</p>
<table class="form-table">
    <tr>
        <th scope="row">
            <label for="<?= Options::SUBTITLE ?>">Підзаголовок:</label>
        </th>
        <td>
            <input
                id="<?= Options::SUBTITLE ?>"
                name="<?= Options::SUBTITLE ?>"
                value="<?= esc_attr($subtitle); ?>"
                class="regular-text"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::SUBTITLE]) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::HERO_IMAGE_ID ?>">Зображення героя:</label>
        </th>
        <td>
            <input
                type="hidden"
                id="<?= Options::HERO_IMAGE_ID ?>"
                name="<?= Options::HERO_IMAGE_ID ?>"
                value="<?= esc_attr($hero_image_id); ?>"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::HERO_IMAGE_ID]) ?>"
            />
            <div id="hero-image-preview">
                <?php if ($hero_image_url): ?>
                    <img
                        src="<?= esc_url($hero_image_url); ?>"
                        alt="hero image"
                        style="max-width:150px; display:block; margin-bottom:8px;"
                    />
                <?php endif; ?>
            </div>
            <button
                type="button"
                class="button"
                id="select-hero-image"
            >Обрати зображення</button>
            <button
                type="button"
                class="button"
                id="remove-hero-image"
                <?= $hero_image_id ? '' : ' style="display:none;"' ?>
            >Видалити</button>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label>Позиція зображення:</label>
        </th>
        <td style="position: relative;">
            <label
                for="<?= Options::HERO_IMAGE_TOP ?>"
                style="position: absolute; top: -1px; font-size: 12px; color: #999;"
            >top:</label>
            <input
                type="number"
                id="<?= Options::HERO_IMAGE_TOP ?>"
                name="<?= Options::HERO_IMAGE_TOP ?>"
                value="<?= esc_attr($hero_image_top); ?>"
                class="small-text"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::HERO_IMAGE_TOP]) ?>"
            />
            <label for="<?= Options::HERO_IMAGE_TOP ?>">px</label>
            <label
                for="<?= Options::HERO_IMAGE_RIGHT ?>"
                style="position: absolute; top: -1px; font-size: 12px; color: #999;"
            >right:</label>
            <input
                type="number"
                id="<?= Options::HERO_IMAGE_RIGHT ?>"
                name="<?= Options::HERO_IMAGE_RIGHT ?>"
                value="<?= esc_attr($hero_image_right); ?>"
                class="small-text"
                aria-label="Y позиція зображення героя"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::HERO_IMAGE_RIGHT]) ?>"
            />
            <label for="<?= Options::HERO_IMAGE_RIGHT ?>">px</label>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::TITLE_COLOR ?>">Колір заголовку:</label>
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
            <label for="<?= Options::SUBTITLE_COLOR ?>">Колір підзаголовку:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::SUBTITLE_COLOR ?>"
                name="<?= Options::SUBTITLE_COLOR ?>"
                value="<?= esc_attr(get_option(Options::SUBTITLE_COLOR, '#000')); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::SUBTITLE_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::BACKGROUND_COLOR ?>">Колір фону:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::BACKGROUND_COLOR ?>"
                name="<?= Options::BACKGROUND_COLOR ?>"
                value="<?= esc_attr(get_option(Options::BACKGROUND_COLOR, '#ededed')); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::BACKGROUND_COLOR])) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::COLOR_FOR_GRADIENT ?>">Колір для градієнту:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::COLOR_FOR_GRADIENT ?>"
                name="<?= Options::COLOR_FOR_GRADIENT ?>"
                value="<?= esc_attr(get_option(Options::COLOR_FOR_GRADIENT, Options::DEFAULTS[Options::COLOR_FOR_GRADIENT])); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(expand_short_hex(Options::DEFAULTS[Options::COLOR_FOR_GRADIENT])) ?>"
            />
            <p class="description">
                Цей колір буде використовуватися як другий колір для градієнту фону
                <br>Буде застосовуватися лише якщо в блоці увімкнено "Градієнт фону"
            </p>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="reset-hero-settings">Скинути на стандартні налаштування:</label>
        </th>
        <td>
            <button
                type="button"
                class="button button-secondary"
                id="reset-hero-settings"
            >Скинути</button>
            <p class="description">Після скидання необхідно зберегти зміни, щоб застосувати стандартні значення</p>
        </td>
    </tr>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initMediaSelector();
    });

    document.getElementById('reset-hero-settings').addEventListener('click', function() {
        resetHeroSettings();
    });

    function initMediaSelector() {
        const selectBtn  = document.getElementById('select-hero-image');
        const removeBtn  = document.getElementById('remove-hero-image');
        const imageInput = document.getElementById('<?= Options::HERO_IMAGE_ID ?>');
        const previewDiv = document.getElementById('hero-image-preview');

        let frame;

        selectBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Обрати зображення героя',
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

    function resetHeroSettings() {
        document.querySelectorAll('[data-default]').forEach(function(input) {
            if (input.type === 'checkbox') {
                input.checked = input.getAttribute('data-default') === '1';
            } else {
                input.value = input.getAttribute('data-default');
            }
        });
        document.getElementById('hero-image-preview').innerHTML = '';
        document.getElementById('remove-hero-image').style.display = 'none';
    }
</script>
