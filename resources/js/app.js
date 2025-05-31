import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();
console.log('Alpine.js initialized');
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
    const toggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;

    // Cargar modo oscuro desde localStorage
    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
    }

    if (toggle) {
        toggle.addEventListener('click', () => {
            console.log('Toggle clicked');
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    }
});
