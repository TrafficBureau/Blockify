document.addEventListener('DOMContentLoaded', function() {

    const section = document.querySelector('.pro-block-steps[itemtype="https://schema.org/HowTo"]');

    if (!section) {
        return;
    }

    let node = section.previousElementSibling;
    let found = '';

    while(node && !found) {
        if (node.matches && (node.matches('h2') || node.matches('h3') || node.matches('h4'))) {
            found = node.textContent.trim();
        }
        node = node.previousElementSibling;
    }

    if (found) {
        document.getElementById('howto-block-name-meta').setAttribute('content', found);
    }

});