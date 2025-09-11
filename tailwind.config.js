import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],

    darkMode: 'class', // Enable dark mode via the "dark" class

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                darkBg: '#1f2937',   // Optional custom dark background
                darkText: '#f3f4f6', // Optional custom text for dark mode
            },
        },
    },

    plugins: [forms],
};
