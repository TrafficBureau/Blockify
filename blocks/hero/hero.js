document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.js-blockify-cards');

    if (container === null) {
        return;
    }

    const cards = Array.from(container.querySelectorAll('.js-blockify-card'));
    const total = cards.length;

    if (total === 0) {
        return;
    }

    if (total % 2 === 0) {
        for (let i = 0; i < 2; i++) {
            const empty = document.createElement('div');
            empty.classList.add('card', 'empty');
            container.insertBefore(empty, container.firstChild);
        }
        return;
    }

    const empty = document.createElement('div');
    empty.classList.add('card', 'empty');
    container.insertBefore(empty, cards[1] || null);
});
