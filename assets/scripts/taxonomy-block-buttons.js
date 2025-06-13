(function ($, wp) {
    if (!$('#edittag').length) {
        return;
    }

    const {
        createElement,
        render,
        unmountComponentAtNode,
        useState
    } = wp.element;
    const { Modal, Button } = wp.components;
    const { BlockEditorProvider, BlockList, WritingFlow } = wp.blockEditor;
    const { createBlock, serialize } = wp.blocks;

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
                .data('label', block.label)
                .on('click', () => openEditor(block.name, textarea, button));
            container.append(button);
        });

        textarea.before(container);
    });

    function openEditor(blockName, textarea, btn) {
        const wrapper = $('<div class="blockify-modal"></div>').appendTo('body')[0];

        function ModalComponent() {
            const [blocksState, setBlocks] = useState([createBlock(blockName)]);

            const insertBlock = () => {
                const content = serialize(blocksState);
                const current = textarea.val();
                textarea.val(current ? current + "\n" + content : content);
                close();
                btn.text('Додано!');
                setTimeout(() => btn.text(btn.data('label')), 1500);
            };

            const close = () => {
                unmountComponentAtNode(wrapper);
                $(wrapper).remove();
            };

            return createElement(
                Modal,
                { title: 'Редагувати блок', onRequestClose: close, className: 'blockify-taxonomy-editor' },
                createElement(
                    BlockEditorProvider,
                    { value: blocksState, onInput: setBlocks, onChange: setBlocks },
                    createElement(WritingFlow, null,
                        createElement(BlockList)
                    )
                ),
                createElement('div', { style: { marginTop: '16px' } },
                    createElement(Button, { isPrimary: true, onClick: insertBlock }, 'Insert')
                )
            );
        }

        render(createElement(ModalComponent), wrapper);
    }
})(jQuery, window.wp);
