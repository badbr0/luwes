import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],

    safelist: [
        'bg-green-100','text-green-800',
        'bg-yellow-100','text-yellow-800',
        'bg-red-100','text-red-800',
        'bg-blue-100','text-blue-800',
        'bg-purple-100','text-purple-800',
        'bg-blue-600','hover:bg-blue-700',
        'bg-purple-600','hover:bg-purple-700',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
}
