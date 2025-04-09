import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
        },
    },
	
	/*
	server: {
        host: '192.168.137.1', // Adresse IP de votre ordinateur
        port: 5173,            // Le port que Vite utilise
        strictPort: true,      // Assure que Vite utilise exactement ce port
    }
	*/
});