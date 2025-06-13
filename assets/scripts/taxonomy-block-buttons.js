(function ($) {
    if (!$('#edittag').length) {
        return;
    }

    const blocks = [
        { name: 'acf/hero', label: 'Hero' },
        { name: 'acf/iframe-lazy-blockify', label: 'Iframe Lazy' },
        { name: 'acf/pro-steps-blockify', label: 'Pro Block Steps' },
    ];

    $(function () {
        const textarea = $('#description');
        const container = $('<div class="blockify-buttons" style="margin-bottom:8px;"></div>');

        blocks.forEach(block => {
            const button = $('<button type="button" class="button" style="margin-right:4px;"></button>')
                .text(block.label)
                .on('click', () => {
                    const snippet = `<!-- wp:${block.name} /-->`;
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(snippet);
                    } else {
                        const temp = $('<textarea>').appendTo('body').val(snippet).select();
                        document.execCommand('copy');
                        temp.remove();
                    }
                    button.text('Скопійовано!');
                    setTimeout(() => button.text(block.label), 1500);
                });
            container.append(button);
        });

        textarea.before(container);
    });
})(jQuery);
