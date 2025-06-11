(function($){
    if (!$("#edittag").length) return;

    const textarea = $("#tag-description");
    const container = $('<div id="blockify-taxonomy-editor"></div>');
    textarea.hide().after(container);

    const initialBlocks = wp.blocks.parse(textarea.val());
    const onChange = (blocks) => textarea.val(wp.blocks.serialize(blocks));

    wp.element.render(
        wp.element.createElement(
            wp.blockEditor.BlockEditorProvider,
            { value: initialBlocks, onInput: onChange },
            wp.element.createElement(
                wp.blockEditor.BlockTools,
                { __experimentalSelector: '.block-editor-block-list__layout' },
                wp.element.createElement(wp.blockEditor.BlockList)
            )
        ),
        container[0]
    );
})(jQuery);
