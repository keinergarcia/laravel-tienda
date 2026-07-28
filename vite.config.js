import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',  // ✅ CSS personalizado
                'resources/js/app.js',
                'resources/js/custom.js'     // ✅ JS personalizado
            ],
            refresh: true, // Habilita recarga automática
        }),
    ],
});
