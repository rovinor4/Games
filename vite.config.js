import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['node_modules/bootstrap/dist/css/bootstrap.css', 'node_modules/bootstrap-icons/font/bootstrap-icons.css'],
            refresh: true,
        }),
    ],
});
