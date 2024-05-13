import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: [
                'resources/js/app.jsx',
                'resources/js/Pages/Interviews/Index.jsx'
            ],
            refresh: true,
        }),
    ],
});
