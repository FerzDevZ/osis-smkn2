import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                primary: '#1F2A44',
                primary2: '#2D3C62',
                accent1: '#F6E9D7',
                accent2: '#E6B656',
                accent3: '#638A55',
                accent4: '#C48D60',
                ink: '#1A2233',
                glass: 'rgba(255, 255, 255, 0.7)',
                'glass-dark': 'rgba(26, 34, 51, 0.7)',
            },
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', 'sans-serif'],
            },
            backdropBlur: {
                xs: '2px',
            },
            borderRadius: {
                '2xl': '1.5rem',
                '3xl': '2rem',
            },
            boxShadow: {
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                'glass-hover': '0 8px 32px 0 rgba(31, 38, 135, 0.15)',
            },
            animation: {
                'blob': 'blob 7s infinite',
                'fade-in': 'fadeIn 0.5s ease-out forwards',
            },
            keyframes: {
                blob: {
                    '0%': { transform: 'translate(0px, 0px) scale(1)' },
                    '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                    '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    '100%': { transform: 'translate(0px, 0px) scale(1)' },
                },
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            }
        },
    },

    plugins: [forms],
};
