const toggleButton = document.getElementById('theme-toggle');
let isDarkMode = false;

toggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    isDarkMode = !isDarkMode;
    if (isDarkMode) {
        toggleButton.textContent = '☀️';
    } else {
        toggleButton.textContent = '🌙';
    }
});