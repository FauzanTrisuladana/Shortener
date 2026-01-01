import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/home.css',
                'resources/css/dashboard.css',
                'resources/css/auth.css',
                'resources/js/app.js',
                'resources/js/home.js',
                'resources/js/dashboard.js',
                'resources/js/layout-darkmode.js',
                'resources/js/auth-darkmode.js',
                'resources/js/analytics.js',
                'resources/js/links.js',
                'resources/js/link-analytics.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
