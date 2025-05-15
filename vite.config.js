import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // server: {
    //     cors: {
    //       origin: 'http://otc_mis.example.com:8001', // Allow your origin
    //       // origin: '*', // use this for development purposes only, and remove before production.
    //       methods: ['GET', 'HEAD', 'PUT', 'PATCH', 'POST', 'DELETE'],
    //       preflightContinue: true,
    //     },
    //   },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/dropdown.js',
		'resources/js/modal.js'
            ],
            refresh: true,
        }),
    ],
});
