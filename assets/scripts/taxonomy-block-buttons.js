(function ($, wp) {
    const copyToClipboard = (text) => {
        if (navigator.clipboard && window.isSecureContext) {
            return navigator.clipboard.writeText(text);
        }

        return new Promise((resolve, reject) => {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();

            try {
                document.execCommand('copy');
                resolve();
            } catch (err) {
                reject(err);
            } finally {
                document.body.removeChild(textarea);
            }
        });
    };

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
        { name: 'acf/hero', label: 'Hero', },
        { name: 'acf/iframe-lazy-blockify', label: 'Iframe Lazy', },
        { name: 'acf/pro-steps-blockify', label: 'Pro Block Steps', },
    ];

    const ModalComponent = ({ blockName, onCopy, }) => {
        const [blocksState, setBlocks] = useState([createBlock(blockName)]);

        const copyBlock = () => {
            const content = serialize(blocksState);
            onCopy(content);
        };

        return createElement(
            Modal,
            {
                title: 'Редагувати блок',
                onRequestClose: () => onCopy(),
                className: 'blockify-taxonomy-editor',
            },
            createElement(
                BlockEditorProvider,
                { value: blocksState, onInput: setBlocks, onChange: setBlocks, },
                createElement(WritingFlow, null, createElement(BlockList))
            ),
            createElement(
                'div',
                { style: { marginTop: '16px' }, },
                createElement(Button, { isPrimary: true, onClick: copyBlock, }, 'Копіювати')
            )
        );
    };

    const openEditor = (blockName, btn) => {
        const wrapper = $('<div class="blockify-modal"></div>').appendTo('body')[0];

        const handleClose = (content) => {
            unmountComponentAtNode(wrapper);
            $(wrapper).remove();

            if (content) {
                copyToClipboard(content).then(() => {
                    btn.text('Скопійовано!');
                    setTimeout(() => btn.text(btn.data('label')), 1500);
                });
            }
        };

        render(createElement(ModalComponent, { blockName, onCopy: handleClose, }), wrapper);
    };

    const createButtons = () => {
        const container = $('<div class="blockify-buttons" style="margin-bottom:8px;"></div>');

        blocks.forEach((block) => {
            const button = $('<button type="button" class="button" style="margin-right:4px;"></button>')
            .text(block.label)
            .data('label', block.label)
            .on('click', () => openEditor(block.name, button));
            container.append(button);
        });

        $('#description').before(container);
    };

    $(createButtons);

})(jQuery, window.wp);
