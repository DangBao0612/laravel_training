import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
        // cho auth/Tailwind
        'resources/css/app.css',
        'resources/js/app.js',
        // cho dashboard
        'resources/js/dashboard.js',
        'resources/scss/dashboard.scss',
        ],
            refresh: true,
        }),
        viteStaticCopy({
      targets: [
        {
          src: 'public/assets/fonts/*',
          dest: 'assets/fonts'
        }
      ]
    })
    ],
});
