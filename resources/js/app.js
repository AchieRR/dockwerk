const demoForm = document.querySelector('#login-form');

document.querySelectorAll('[data-demo-email]').forEach((button) => {
    button.addEventListener('click', () => {
        demoForm.elements.email.value = button.dataset.demoEmail;
        demoForm.elements.password.value = 'dockwerk-demo';
        demoForm.querySelector('[type="submit"]').focus();
    });
});

if (document.body.classList.contains('mode-home')) {
    import('./home-motion.js').then(({ startHomeMotion }) => startHomeMotion());
}
