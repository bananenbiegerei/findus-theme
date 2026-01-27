# BB WMDE Theme

## Installation & Setup

### Node Modules

The first thing to do after cloning the repo is to install node modules for the project: `npm install`.

### Git Submodules

This theme uses two git submodules:

**bb-blocks** - ACF flexible content blocks
Repository: `https://github.com/bananenbiegerei/bb-blocks`

**bb-components** - Reusable theme components (navbars, footers, etc.)
Repository: `https://github.com/bananenbiegerei/bb-components`

Install both submodules by running:

```bash
git submodule update --init --recursive
```

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

ACF field groups are stored as JSON files for version control and synchronization.

**Directory structure:**
- `bb-blocks/acf-json/` - Field groups for the blocks submodule (managed in bb-blocks repo)
- `acf-json/` - Theme-specific field groups (currently empty, for custom fields)

**How it works:**
1. ACF automatically saves field group changes to JSON files in the `acf-json` directory
2. On other environments, ACF detects JSON changes and syncs them to the database
3. Sync manually via WP Admin → ACF → Sync Available

**Best practice:** Always commit JSON changes after editing field groups in wp-admin.

## String Translations

The theme will set the constant `BB_TEXT_DOMAIN` to the value setup in `style.css`. When using localization functions, make sure to use `BB_TEXT_DOMAIN` as the text domain. For example:

`<?php _e('my example text', BB_TEXT_DOMAIN); ?>`

## Features

When logged in the current page can be edited by pressing `CTLR-E`.

## Tailwind CSS v4

This theme uses Tailwind CSS v4 with the new CSS-first configuration.

### Configuration

**Main entry point:** `src/css/tailwind.css`

```css
@import "tailwindcss";
@source "../../**/*.php";
@source "../../bb-blocks/**/*.php";
```

- `@import "tailwindcss"` - Loads Tailwind base, components, and utilities
- `@source` - Tells Tailwind where to scan for class usage (JIT compilation)

### Theme Colors

Colors are defined in `src/css/ui/colors.css` using OKLCH format with light/dark variants:

```css
@theme {
  --color-primary-light: oklch(0.85 0.10 259.81);
  --color-primary-dark: oklch(0.35 0.15 259.81);
  --color-success: oklch(0.60 0.15 145);
  /* etc. */
}
```

The `@theme` directive registers CSS variables as Tailwind utilities (e.g., `bg-primary-light`, `text-success`).

### Basecoat UI

This theme uses [Basecoat UI](https://basecoatui.com) for components. Theme customization is in:
- `src/css/basecoat-theme.css` - Generated theme from [tweakcn.com](https://tweakcn.com)
- `src/css/theme.css` - Custom overrides

## Colors

### Defining Colors for ACF Fields

To add color choices to ACF select fields, use filters in `functions/acf-blocks.php`:

```php
add_filter('acf/load_field/name=background_color', function ($field) {
    $field['choices'] = [
        'default' => 'Default',
        'primary-light' => 'Primary Light',
        'primary-dark' => 'Primary Dark',
        'neutral-light' => 'Neutral Light',
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

## Upstream (bb-starter-theme)

This theme uses [bb-starter-theme](https://github.com/bananenbiegerei/bb-starter-theme) as an upstream template. Changes from upstream can be merged into this theme.

### Initial setup (once)

```bash
git remote add upstream https://github.com/bananenbiegerei/bb-starter-theme.git
```

### Pull changes from upstream

```bash
git fetch upstream
git merge upstream/main --allow-unrelated-histories
```

After merging, update submodules to match the upstream references:

```bash
git submodule update --init --recursive
```

### Update submodules to latest

```bash
# Update all submodules to latest remote commit
git submodule update --remote

# Or update a specific one
git submodule update --remote bb-blocks
```

After updating submodules, commit the new reference:

```bash
git add bb-blocks bb-components
git commit -m "Update submodules"
```

## Fork for BB Starter Theme projects

To recycle the bb theme for different projects you can fork the bb theme.

1. Fork the main repo: go to github and fork there
2. Clone the forked repo
3. Install blocks submodule: `git submodule update --init --recursive`
4. Add upstream remote: `git remote add upstream https://github.com/bananenbiegerei/bb-starter-theme.git`
5. Cleanup unnecessary files
