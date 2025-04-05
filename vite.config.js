import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import dotenv from 'dotenv';

export default defineConfig({
    // base: process.env.APP_URL + '/build/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/tailwind.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
