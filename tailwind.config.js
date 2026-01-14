import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#e8f1fa',
                    100: '#d1e3f5',
                    200: '#a3c7eb',
                    300: '#75abe1',
                    400: '#6b9cd9',
                    500: '#5081C6',
                    600: '#4169b0',
                    700: '#345391',
                    800: '#273e6d',
                    900: '#1a2948',
                },
                secondary: {
                    50: '#fff8eb',
                    100: '#fff1d6',
                    200: '#ffe3ad',
                    300: '#ffd685',
                    400: '#fec85c',
                    500: '#FD9F31',
                    600: '#e68927',
                    700: '#bf721f',
                    800: '#995b19',
                    900: '#734513',
                },
                accent: {
                    50: '#fffaeb',
                    100: '#fff4d6',
                    200: '#ffeaad',
                    300: '#ffdf85',
                    400: '#ffd45c',
                    500: '#FEBB13',
                    600: '#e5a610',
                    700: '#bf8a0d',
                    800: '#996e0b',
                    900: '#735308',
                },
                gray: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                }
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'card': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
            }
        },
    },

    plugins: [forms],
};
