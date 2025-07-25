import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url';
import svgLoader from 'vite-svg-loader'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    tailwindcss(),
    vue(),
    svgLoader({
      svgo: true,
      svgoConfig: {
        multipass: true,
        plugins: [
          {
            name: 'removeAttrs',
            params: {
              attrs: ['fill', 'width', 'height', 'clip-path']
            },
          },
          { name: 'removeViewBox', active: false },
        ],
      },
    })
  ],
  resolve: {
    alias: {
      '@assets': fileURLToPath(new URL('./resources/assets', import.meta.url)),
      '@icons': fileURLToPath(new URL('./resources/assets/icons', import.meta.url)),
    },
  },
});
