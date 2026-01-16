<?php

// Set to true to load all BB blocks without checking ACF options
define('BB_LOAD_ALL_BB_BLOCKS', false);

// Define this to limit which blocks will be loaded
//define('WMDE_ALLOWED_BB_BLOCKS', ['image', 'card']);

define('BB_ALLOWED_WP_BLOCKS', ['core/column', 'core/columns', 'core/html']);

require_once get_template_directory() . '/bb-blocks/init.php';
