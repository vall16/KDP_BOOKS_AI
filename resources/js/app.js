import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// import './bootstrap';
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

// === LOADER LINK HANDLER ===
document.addEventListener("DOMContentLoaded", () => {
    const loader = document.getElementById('global-loader');
    if (!loader) return;

    document.querySelectorAll('a.loader-link, button.loader-link').forEach(el => {
        el.addEventListener('click', e => {
            const href = el.getAttribute('href');

            // Ignora anchor link
            if (href && href.startsWith('#')) return;

            // Evita blocco su form submit come il logout
            if (el.closest('form')) return;

            e.preventDefault();
            loader.classList.remove('hidden');

            setTimeout(() => {
                if (el.tagName === 'A' && href) {
                    window.location.href = href;
                }
            }, 500);
        });
    });
});

