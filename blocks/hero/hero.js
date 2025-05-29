document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.js-blockify-cards');

    if (containers.length === 0) {
        return;
    }

    containers.forEach(function (container) {
        const cards = Array.from(container.querySelectorAll('.js-blockify-card'));
        const total = cards.length;

        if (total === 0) {
            return;
        }

        if (total % 2 === 0) {
            for (let i = 0; i < 2; i++) {
                const empty = document.createElement('li');
                empty.classList.add('card', 'empty');
                container.insertBefore(empty, container.firstChild);
            }
        } else {
            const empty = document.createElement('li');
            empty.classList.add('card', 'empty');
            container.insertBefore(empty, cards[1] || null);
        }
    });
});
