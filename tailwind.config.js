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
                brand: {
                    dark: '#1e3a8a', // Header/Sidebar Dark Blue
                    light: '#f3f4f6', // Main Background
                    accent: '#7c3aed', // Purple Accent
                },
                'midnight-blue': {
                    DEFAULT: '#193E6B',
                    50: '#E8EEF5',
                    100: '#D1DDEB',
                    200: '#A3BBD7',
                    300: '#7599C3',
                    400: '#4777AF',
                    500: '#193E6B',
                    600: '#143256',
                    700: '#0F2541',
                    800: '#0A192C',
                    900: '#050C16',
                },
            },
        },
    },

    plugins: [forms],
};
