import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('dark-toggle');
    const html = document.documentElement;

    // Ielādē iepriekšējo preferenci
    if (localStorage.getItem('darkMode') === 'true') {
        html.classList.add('dark');
    }

    // Toggle poga
    if (toggleButton) {
        toggleButton.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('darkMode', html.classList.contains('dark'));
        });
    }
});
