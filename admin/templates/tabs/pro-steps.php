<?php

use TrafficBureau\Blockify\ProSteps\Options;

if (!defined('ABSPATH')) {
    exit;
}

$number_color       = Options::getFieldWithDefaults(Options::NUMBER_COLOR);
$background_color   = Options::getFieldWithDefaults(Options::BACKGROUND_COLOR);
$color_for_gradient = Options::getFieldWithDefaults(Options::COLOR_FOR_GRADIENT);
$line_color         = Options::getFieldWithDefaults(Options::LINE_COLOR);

?>

<p class="description" style="margin-top: 20px;">
    На цій сторінці можна встановити стандартні значення для блоку Pro Steps
</p>

<table class="form-table">
    <tr>
        <th scope="row">
            <label for="<?= Options::NUMBER_COLOR ?>">Колір номеру:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::NUMBER_COLOR ?>"
                name="<?= Options::NUMBER_COLOR ?>"
                value="<?= esc_attr($number_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::NUMBER_COLOR]) ?>"
            />
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::BACKGROUND_COLOR ?>">Колір фону:</label>
        </th>
        <td>
            <input
                type="hidden"
                id="<?= Options::BACKGROUND_COLOR ?>"
                name="<?= Options::BACKGROUND_COLOR ?>"
                value="<?= esc_attr($background_color); ?>"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::BACKGROUND_COLOR]) ?>"
            />
            <div id="background-color-picker"></div>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::COLOR_FOR_GRADIENT ?>">Другий колір фону для градієнту:</label>
        </th>
        <td>
            <input
                type="hidden"
                id="<?= Options::COLOR_FOR_GRADIENT ?>"
                name="<?= Options::COLOR_FOR_GRADIENT ?>"
                value="<?= esc_attr($color_for_gradient); ?>"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::COLOR_FOR_GRADIENT]) ?>"
            />
            <div id="gradient-color-picker"></div>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="<?= Options::LINE_COLOR ?>">Колір лінії:</label>
        </th>
        <td>
            <input
                type="color"
                id="<?= Options::LINE_COLOR ?>"
                name="<?= Options::LINE_COLOR ?>"
                value="<?= esc_attr($line_color); ?>"
                style="vertical-align: middle;"
                data-default="<?= esc_attr(Options::DEFAULTS[Options::LINE_COLOR]) ?>"
            />
        </td>
    </tr>
    <tr>
        <th>
            <label for="reset-pro-steps-settings">Скинути на стандартні налаштування:</label>
        </th>
        <td>
            <button
                type="button"
                class="button button-secondary"
                id="reset-pro-steps-settings"
            >Скинути</button>
            <p class="description">Після скидання необхідно зберегти зміни, щоб застосувати стандартні значення</p>
        </td>
    </tr>
</table>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

<script>
    let backgroundPickr;
    let gradientPickr;

    document.addEventListener('DOMContentLoaded', function() {
        const backgroundInput = document.getElementById('<?= Options::BACKGROUND_COLOR ?>');
        const gradientInput   = document.getElementById('<?= Options::COLOR_FOR_GRADIENT ?>');

        backgroundPickr = Pickr.create({
            el: '#background-color-picker',
            theme: 'classic',
            default: backgroundInput.value,
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    input: true,
                    save: true,
                }
            }
        });

        gradientPickr = Pickr.create({
            el: '#gradient-color-picker',
            theme: 'classic',
            default: gradientInput.value,
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: {
                    input: true,
                    save: true,
                }
            }
        });

        backgroundPickr.on('change', color => {
            backgroundInput.value = color.toHEXA().toString(3);
        });

        gradientPickr.on('change', color => {
            gradientInput.value = color.toHEXA().toString(3);
        });

        document.getElementById('reset-pro-steps-settings').addEventListener('click', function() {
            document.querySelectorAll('[data-default]').forEach(input => {
                input.value = input.getAttribute('data-default');
            });
            backgroundPickr.setColor(backgroundInput.value);
            gradientPickr.setColor(gradientInput.value);
        });
    });
</script>
