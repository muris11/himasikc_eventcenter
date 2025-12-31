import react from "@vitejs/plugin-react";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: false, // Disable auto refresh to prevent infinite reload loop
        }),
        react(),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: false,
            ignored: ['**/vendor/**', '**/node_modules/**', '**/storage/**'],
        },
    },
    css: {
        devSourcemap: true,
    },
    build: {
        cssCodeSplit: true,
        minify: "terser",
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['alpinejs'],
                },
            },
        },
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                passes: 2,
            },
            mangle: true,
            format: {
                comments: false,
            },
        },
        chunkSizeWarningLimit: 1000,
        sourcemap: false,
    },
});
