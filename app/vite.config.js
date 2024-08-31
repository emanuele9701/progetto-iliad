import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/font-awesome.min.css',
                'resources/js/app.js',
                'resources/js/lib/jquery/jquery.js',
                'resources/js/lib/DataTables/datatables.js',
                'resources/js/lib/DataTables/datatables.css',
                'resources/js/home.js',
            ],
            refresh: true,
        }),
    ],
});
