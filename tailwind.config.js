import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                blue: {
                    light: '#C5DFFF',
                    dark: '#061E3C',
                    hover: '#1057B0'
                },
            },
            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            }
        }

    },

    plugins: [],
};
