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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
        imperialBlue: '#170098', // or use RGB: 'rgb(0, 90, 146)'
         },
            backgroundColor: {
                imperialBlue: '#170098', // or use RGB: 'rgb(0, 90, 146)'
            },
            textColor: {
                imperialBlue: '#170098', // or use RGB: 'rgb(0, 90, 146)'
            },
        },
    },

    plugins: [forms],
};
