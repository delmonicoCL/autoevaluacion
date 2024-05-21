import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

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
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js", // Asegura que se use el compilador de plantillas en tiempo de ejecución
        },
    },
});
