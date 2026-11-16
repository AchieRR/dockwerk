const demoForm = document.querySelector('#login-form');

document.querySelectorAll('[data-demo-email]').forEach((button) => {
    button.addEventListener('click', () => {
        demoForm.elements.email.value = button.dataset.demoEmail;
        demoForm.elements.password.value = 'dockwerk-demo';
        demoForm.querySelector('[type="submit"]').focus();
    });
});

if (document.body.classList.contains('mode-home')) {
    const menu = document.querySelector('.mobile-menu');

    menu.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menu.open) {
            menu.open = false;
            menu.querySelector('summary').focus();
        }
    });

    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        menu.open = false;
    }));

    const motionPreference = matchMedia('(prefers-reduced-motion: no-preference)');
    if (motionPreference.matches) {
        import('./home-motion.js').then(({ startHomeMotion }) => startHomeMotion());
    } else {
        motionPreference.addEventListener('change', () => {
            import('./home-motion.js').then(({ startHomeMotion }) => startHomeMotion());
        }, { once: true });
    }
}
