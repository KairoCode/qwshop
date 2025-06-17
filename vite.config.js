import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import legacy from '@vitejs/plugin-legacy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/plugins/css/base.scss'
            ],
            refresh: true,
        }),
        vue({
            template: {
                compilerOptions: {
                    // Vue 3 specific template options
                },
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,
                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
        legacy({
            targets: ['defaults', 'not IE 11'],
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            'vue': 'vue/dist/vue.esm-bundler.js',
            'vue-router': 'vue-router/dist/vue-router.esm-bundler.js',
            'vuex': '/node_modules/vuex/dist/vuex.esm-bundler.js'
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                // additionalData: `@use "@/plugins/css/base.scss" as *;`,
                silenceDeprecations: ['legacy-js-api']
            },
        },
    },
    build: {
        outDir: 'public/build',
        manifest: true,
        assetsDir: 'assets',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name].[hash].[ext]',
                chunkFileNames: 'assets/[name].[hash].js',
                entryFileNames: 'assets/[name].[hash].js',
                globals: {
                    'vue': 'Vue',
                    'vue-router': 'VueRouter',
                    'vuex': 'Vuex',
                    'element-plus': 'ElementPlus',
                    'dayjs':'dayjs',
                    'qrcode.vue':'QrcodeVue',
                    'clipboardjs':'ClipboardJS',
                    'g2plot':'G2Plot',
                    'amap-loader':'AMapLoader',
                    'vue-i18n':'VueI18n',
                },
                // 手动拆分依赖
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        // 将大依赖单独拆包
                        if (id.includes('lodash')) {
                            return 'vendor-lodash';
                        }
                        if (id.includes('element-plus')) {
                            return 'vendor-element-plus';
                        }
                        return 'vendor'; // 其他依赖打包到 vendor
                    }
                },
            },
            external: ['vue', 'vue-router','vuex','element-plus','dayjs','qrcode.vue','clipboardjs','g2plot','amap-loader','vue-i18n'],
        },
        // 调整警告阈值（可选）
        chunkSizeWarningLimit: 2000, // 默认 500KB，调整为 1000KB
    },
});
