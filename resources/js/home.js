// Home page JavaScript

// Copy to clipboard function
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL berhasil disalin!');
    }, function(err) {
        console.error('Gagal menyalin: ', err);
    });
};

// Dark mode functionality for home page
window.toggleDarkModeHome = function() {
    const body = document.body;
    const icon = document.getElementById('darkModeIconHome');

    body.classList.toggle('light-mode');

    if (body.classList.contains('light-mode')) {
        icon.classList.remove('bi-brightness-high');
        icon.classList.add('bi-moon-fill');
        localStorage.setItem('homeMode', 'light');
    } else {
        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-brightness-high');
        localStorage.setItem('homeMode', 'dark');
    }
};

// Check for saved mode preference on home page
document.addEventListener('DOMContentLoaded', function() {
    const homeMode = localStorage.getItem('homeMode');
    const icon = document.getElementById('darkModeIconHome');

    if (homeMode === 'light') {
        document.body.classList.add('light-mode');
        icon.classList.remove('bi-brightness-high');
        icon.classList.add('bi-moon-fill');
    }
});
