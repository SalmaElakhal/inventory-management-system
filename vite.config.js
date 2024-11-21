import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
   
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue()
    ],
     optimizeDeps: {
    include: ['jquery']  // Assurez-vous que jQuery est bien inclus dans l'optimisation des dépendances
  },
    resolve: {
        alias: {
            vue : 'vue/dist/vue.esm-bundler.js',
            '@': '/resources/js', // Assurez-vous que cet alias est configuré

        }
    }
});
