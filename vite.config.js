// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import compression from 'vite-plugin-compression';
import { visualizer } from 'rollup-plugin-visualizer';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        compression(),
        visualizer({ open: true, gzipSize: true })
    ],
});