import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/css/index.css', 'resources/js/index.jsx'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0'
    },
});


