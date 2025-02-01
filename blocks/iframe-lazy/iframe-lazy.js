document.addEventListener('DOMContentLoaded', function () {
    wpIframeLazyHandler();
})
const wpIframeLazyHandler = () => {
    const iframeWrapperElements = document.querySelectorAll('.wp-iframe-lazy-wrapper');

    if (!iframeWrapperElements.length) return;

    iframeWrapperElements.forEach(wrapper => {
        const overlay = wrapper.querySelector('.wp-iframe-lazy-overlay');
        const iframe = wrapper.querySelector('iframe');

        if ( overlay ) {
            overlay.addEventListener('click', () => {
                iframe.src = iframe.getAttribute('data-src');
                overlay.remove();
            });
        }
    })
}