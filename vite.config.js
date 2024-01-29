import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            '~ziggy-vue': path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/vue.es.js'),

            '~Layouts': path.resolve(__dirname, 'resources/js/Layouts'),
            '~Pages': path.resolve(__dirname, 'resources/js/Pages'),
            '~Components': path.resolve(__dirname, 'resources/js/Components'),
            '~': path.resolve(__dirname, 'resources'),
        },
    },
    build: {
        chunkSizeWarningLimit: 1000,
    }
});
