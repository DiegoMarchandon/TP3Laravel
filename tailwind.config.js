import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
    ],

    theme: {
        extend: {
            backgroundImage: {
                'custom-light': "url('../public/images/ob9Jwh.jpg')",
                'custom-dark': "url('../public/images/Tattoo62070.jpg')",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'neon-line': {
                '0%, 100%': { transform: 'translateY(0%)' },
                '50%': { transform: 'translateY(100%)' },
            },
            },
            animation: {
                'neon-line': 'neon-line 5s ease-in-out infinite',
            },
        },
    },

    plugins: [forms],
};
