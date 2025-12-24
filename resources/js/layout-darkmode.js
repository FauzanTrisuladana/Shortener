// Dark mode functionality for dashboard layout
window.toggleDarkMode = function() {
    const body = document.body;
    const icon = document.getElementById('darkModeIcon');

    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
        icon.classList.remove('bi-brightness-high');
        icon.classList.add('bi-moon-fill');
        localStorage.setItem('darkMode', 'enabled');
    } else {
        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-brightness-high');
        localStorage.setItem('darkMode', 'disabled');
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const darkMode = localStorage.getItem('darkMode');
    const icon = document.getElementById('darkModeIcon');

    if (darkMode === 'enabled') {
        document.body.classList.add('dark-mode');
        icon.classList.remove('bi-brightness-high');
        icon.classList.add('bi-moon-fill');
    }
});
