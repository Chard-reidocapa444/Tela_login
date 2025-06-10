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

    // Preencher dias
    const daySelect = document.getElementById('day');
    for (let i = 1; i <= 31; i++) {
      const option = document.createElement('option');
      option.value = i;
      option.textContent = i;
      daySelect.appendChild(option);
    }

    // Preencher anos (1900 até o ano atual)
    const yearSelect = document.getElementById('year');
    const currentYear = new Date().getFullYear();
    for (let y = currentYear; y >= 1900; y--) {
      const option = document.createElement('option');
      option.value = y;
      option.textContent = y;
      yearSelect.appendChild(option);
    }

});