(function ($) {
    if (!$('#edittag').length) {
        return;
    }

    $(function () {
        const textarea = $('#description');
        const addButton = $('<button type="button" class="button">Додати блок</button>');
        textarea.after(addButton);
        const modalContainer = $('<div id="blockify-taxonomy-modal"></div>').appendTo('body').hide();

        function TaxonomyModal({ onRequestClose }) {
            const [blocks, setBlocks] = wp.element.useState([]);

            const insertAndClose = () => {
                if (blocks.length) {
                    textarea.val(textarea.val() + wp.blocks.serialize(blocks));
                }
                onRequestClose();
                setBlocks([]);
            };

            return wp.element.createElement(
                wp.components.Modal,
                { title: 'Додати блок', onRequestClose },
                wp.element.createElement(
                    wp.blockEditor.BlockEditorProvider,
                    { value: blocks, onInput: setBlocks },
                    wp.element.createElement(wp.blockEditor.BlockTools, null,
                        wp.element.createElement(wp.blockEditor.BlockList)
                    )
                ),
                wp.element.createElement('div', { style: { marginTop: '16px' } },
                    wp.element.createElement(wp.components.Button, { variant: 'primary', onClick: insertAndClose }, 'Вставити'),
                    wp.element.createElement(wp.components.Button, { style: { marginLeft: '8px' }, onClick: onRequestClose }, 'Скасувати')
                )
            );
        }

        function openModal() {
            wp.element.render(
                wp.element.createElement(TaxonomyModal, { onRequestClose: closeModal }),
                modalContainer[0]
            );
            modalContainer.show();
        }

        function closeModal() {
            wp.element.unmountComponentAtNode(modalContainer[0]);
            modalContainer.hide();
        }

        addButton.on('click', openModal);
    });
})(jQuery);
