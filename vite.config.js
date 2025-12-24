import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from 'vite-plugin-static-copy'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/style.css',
                'resources/js/script.js',
                'resources/js/student.js',
                'resources/js/auth.js'],
            refresh: true,
        }),
        viteStaticCopy({
            targets:[
                {
                    src: "resources/images/**",
                    dest: "../"
                }
            ]
        })
    ],
});
