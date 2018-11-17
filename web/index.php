<?php

$base = __DIR__ . DIRECTORY_SEPARATOR;

require_once $base . 'inc/config.php';

$data = [
    'assetpath' => dirname($_SERVER['PHP_SELF']),
];

if ( ! endsWith($data['assetpath'], DIRECTORY_SEPARATOR) ) {
    $data['assetpath'] .= DIRECTORY_SEPARATOR;
}

echo $twig->render('web', compact('data'));
