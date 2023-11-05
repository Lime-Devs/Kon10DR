import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: "resources/js/app.jsx",
            refresh: true,
        }),
        react(),
    ],
    server: {
        hmr: { host: "kon10dr.us-east-1.elasticbeanstalk.com" },
        port: 3000,
        watch: {
            usePolling: true,
        },
        host: true, // Here
    },
});
