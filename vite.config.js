import { defineConfig, loadEnv } from 'vite';
import { resolve } from 'path';
import tailwindcss from '@tailwindcss/vite';

// Plugin to reload browser on PHP file changes
function phpReload() {
	return {
		name: 'php-reload',
		handleHotUpdate({ file, server }) {
			if (file.endsWith('.php')) {
				server.ws.send({ type: 'full-reload' });
				return [];
			}
		},
	};
}

export default defineConfig(({ mode }) => {
	// Load env file
	const env = loadEnv(mode, process.cwd(), '');

	// Get proxy URL from env (fallback to default)
	const proxyUrl = env.BROWSERSYNC_PROXY_URL || 'http://blueprint.local';
	const openBrowser = env.BROWSERSYNC_OPEN_BROWSER === 'true';

	return {
		plugins: [tailwindcss(), phpReload()],
		build: {
			// Output to dist directory
			outDir: 'dist',
			emptyDirBeforeWrite: true,
			rollupOptions: {
				input: {
					site: resolve(__dirname, 'src/js/site.js'),
					editor: resolve(__dirname, 'src/scss/editor.scss'),
				},
				output: {
					entryFileNames: '[name].js',
					chunkFileNames: '[name].js',
					assetFileNames: '[name].[ext]',
				},
			},
		},
		css: {
			preprocessorOptions: {
				scss: {
					api: 'modern-compiler',
					silenceDeprecations: ['import'],
				},
			},
		},
		server: {
			// Open browser on start
			open: openBrowser ? proxyUrl : false,
			cors: true,
			strictPort: true,
			port: 5173,
			hmr: {
				host: 'localhost',
			},
			// Watch for PHP file changes to trigger reload
			watch: {
				include: ['**/*.php'],
			},
		},
	};
});
