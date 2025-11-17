<?php
// Redirige todo lo de /api/ a los archivos reales
$uri = $_SERVER['REQUEST_URI'];

if (strpos($uri, '/api/') === 0) {
    require __DIR__ . $uri;
    exit;
}

echo "API funcionando";
