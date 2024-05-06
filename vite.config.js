import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue"; // Importa el plugin de Vue

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/app.scss",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
        vue(), // Agrega el plugin de Vue
    ],
});



// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: [
//                 "resources/css/app.css",
//                 "resources/css/app.scss",
//                 "resources/js/app.js",
//             ],
//             refresh: true,
//         }),
//     ],
// });
