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
                'green-gold': {
                    DEFAULT: '#B3A125',
                    50: '#F5F3E8',
                    100: '#EBE7D1',
                    200: '#D7CFA3',
                    300: '#C3B775',
                    400: '#AF9F47',
                    500: '#B3A125',
                    600: '#8F811E',
                    700: '#6B6116',
                    800: '#47400F',
                    900: '#232007',
                },
            },
        },
    },

    plugins: [forms],
};
