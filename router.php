<?php
// Router for PHP built-in server. Allows clean links like /page/home
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    // serve the requested resource as-is if it exists
    if (is_file($file)) {
        return false;
    }
}

// otherwise, delegate all requests to index.php
require_once __DIR__ . '/index.php';
