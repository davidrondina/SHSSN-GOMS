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
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {

                    "primary": "#36579C",

                    "secondary": "#5557FB",

                    "accent": "#F0C13E",

                    "neutral": "#333333",

                    "base-100": "#F0F0F0",

                    "info": "#0088ff",

                    "success": "#00c986",

                    "warning": "#f07000",

                    "error": "#f7004a",
                },
            },
        ],
    },

    plugins: [forms, require('daisyui'), require('@tailwindcss/typography'),],
};
