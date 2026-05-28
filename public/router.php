<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files directly if they exist in public/
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Handle /storage/* paths via the symlink target directly
if (strpos($uri, '/storage/') === 0) {
    $storagePath = __DIR__ . '/../storage/app/public' . substr($uri, strlen('/storage'));
    if (file_exists($storagePath)) {
        $mime = mime_content_type($storagePath);
        header('Content-Type: ' . $mime);
        readfile($storagePath);
        exit;
    }
}

// Otherwise route through Laravel
require_once __DIR__ . '/index.php';
