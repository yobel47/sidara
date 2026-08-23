import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // App ini tidak punya tampilan dark mode sendiri. Pakai strategi 'class'
    // (bukan 'media' default) supaya style dark: cuma aktif kalau ada class
    // "dark" di elemen — dan karena tidak pernah dipasang di mana pun, style
    // dark: itu efeknya nonaktif total, tidak lagi ngikutin prefers-color-scheme
    // OS/browser (yang sebelumnya bikin komponen seperti pagination ikut gelap
    // sendiri padahal sisa halaman tetap terang).
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            padding: {
                'safe-bottom': 'env(safe-area-inset-bottom)',
                'safe-top': 'env(safe-area-inset-top)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
