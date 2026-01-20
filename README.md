# BB WMDE Theme

## Installation & Setup

### Node Modules

The first thing to do after cloning the repo is to install node modules for the project: `npm install`.

### ACF Blocks Submodule

Our ACF blocks are now have their own repository: `https://github.com/bananenbiegerei/bb-blocks`. They can be added to any theme as a submodule.

The `bb-blocks` submodule is installed by running `git submodule update --init` from the project directory.

### BrowserSync

To setup BrowserSync copy the file `.env-example` to `.env` and edit accordingly:

- `BROWSERSYNC_PROXY_URL`: base URL of your local WP instance (e.g. `wkmde.local`, no `http://`!)
- `BROWSERSYNC_OPEN_BROWSER`: start browser when running gulp

## Formatting Standards

Use [Prettier](https://prettier.io) with your IDE to get automatic formatting of the code. Ideally you'll setup your IDE so that files are formatted upon saving.

The Prettier config is defined in `package.json` under the `prettier` key and should be automatically used.

- "printWidth": 200 (80 is way to short for modern screens...)
- "useTabs": true (use tabs instead of spaces)
- "phpVersion": "8.0" (among others will convert `array()` to `[]`...)
- "singleQuote" and "jsxSingleQuote": true (use single quotes by default)

## ACF Blocks

### ACF-JSON

@Ingo noch mal schreiben

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Colors

The colors used in the theme must be declared in (at least) two locations: the Tailwind configuration and a script to load the colors values into the ACF fields.

### Tailwind Config

In `tailwind.config.js`:

```
module.exports = {
	safelist: [
		{
			pattern: /(text|bg)-(black|white|primary|gray|gray-700|primary-50|primary-600|red|red-50|green-50|green-700|neon|neon-800)/,
		},
	],
}
```

### ACF Fields:

In `acf-blocks.php`:

```
add_filter('acf/load_field/name=color_light', function ($field) {
	$field['choices'] = [
		'default' => 'Default',
		'white' => 'White',
		'gray' => 'Gray',
		'red-50' => 'Red',
		'green-50' => 'Green',
		'primary-50' => 'Blue',
		'neon' => 'Neon',
	];
	return $field;
});

add_filter('acf/load_field/name=color_dark', function ($field) {
	$field['choices'] = [
		'default' => 'Default',
		'black' => 'Black',
		'gray-700' => 'Gray',
		'red' => 'Red',
		'green-700' => 'Green',
		'primary' => 'Blue',
		'neon-800' => 'Neon',
	];
	return $field;
});
```

## Development and Build

For development run `npm run dev`.

For building (for production site) run `npm run build`.

For creating an archive to install the theme run `npm run package`. A zip will be created in `dist` with a timestamped theme version. Note that this will also delete all symbolic links in the `acf-json` directory.
Upload zip file to bb server. You wll find a directory called updates/themes. Upload and rename the zip file on server to only "wmde".
Go to wordpress instance -> themes. Mark the theme and check for updates. Then update.

_Do not manually upload files to the live server. Install the theme in the backend with the zipfile (unless it's for an emergency fix)._

## Fork for BB Starter Theme projects

To recycle the bb theme for different projects you can for the bb theme.

1. Fork the main repo: got to github and fork there
2. Clone the forked repo
3. Install blocks submodule: ``` git submodule update --init --recursive ```
4. Cleanup unecessary file
