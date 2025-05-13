document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.querySelector('input[type="password"]');
    const toggleIcon = passwordInput.nextElementSibling;

    if (toggleIcon) {
        toggleIcon.addEventListener('mousedown', () => {
            passwordInput.type = 'text';
        });

        toggleIcon.addEventListener('mouseup', () => {
            passwordInput.type = 'password';
        });

        toggleIcon.addEventListener('mouseleave', () => {
            passwordInput.type = 'password';
        });
    }
});