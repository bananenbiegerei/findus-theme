require('dotenv').config();
const { src, dest, parallel, series, watch } = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const tailwindcss = require('@tailwindcss/postcss');
const cssnano = require('cssnano');
const gulpEsbuild = require('gulp-esbuild');
const { createGulpEsbuild } = require('gulp-esbuild');
const gulpEsbuildIncremental = createGulpEsbuild({ incremental: true });
const browserSync = require('browser-sync').create();

function stylesDev() {
	return src(['./src/css/site.css', './src/css/editor.css'])
		.pipe(sourcemaps.init())
		.pipe(postcss([tailwindcss()]))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('./css'))
		.pipe(browserSync.stream());
}

function stylesProd() {
	return src(['./src/css/site.css', './src/css/editor.css'])
		.pipe(postcss([tailwindcss(), cssnano({ preset: ['default', { calc: false }] })]))
		.pipe(dest('./css'));
}

function esbuildDev() {
	return src('./src/js/site.js')
		.pipe(
			gulpEsbuildIncremental({
				outfile: 'site.js',
				bundle: true,
				sourcemap: true,
			})
		)
		.pipe(dest('./js'));
}

function esbuildProd() {
	return src('./src/js/site.js')
		.pipe(
			gulpEsbuild({
				outfile: 'site.js',
				sourcemap: false,
				bundle: true,
				minify: true,
				minifyWhitespace: true,
				minifyIdentifiers: true,
			})
		)
		.pipe(dest('./js'));
}

function dev() {
	browserSync.init({
		proxy: process.env.BROWSERSYNC_PROXY_URL,
		open: process.env.BROWSERSYNC_OPEN_BROWSER == 'true',
	});
	watch(['./src/css/**/*.css', './bb-blocks/**/*.css'], stylesDev);
	watch(['./src/js/**/*.js', './bb-blocks/**/*.js'], esbuildDev).on('change', browserSync.reload);
	watch('./**/*.php', stylesDev).on('change', browserSync.reload);
	watch(['./img/**/*.*', './fonts/**/*.*']).on('change', browserSync.reload);
}

exports.default = series(parallel(stylesDev, esbuildDev), dev);
exports.build = series(stylesProd, esbuildProd);
exports.styles = stylesDev;
exports.scripts = esbuildDev;
exports.pstyles = stylesProd;
exports.pscripts = esbuildProd;
