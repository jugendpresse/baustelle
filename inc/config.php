<?php

require_once $base . 'vendor/autoload.php';

if (!file_exists( $base . '.env' )) {
    copy($base . '.env.example', $base . '.env');
}
$dotenv = new Dotenv\Dotenv($base );
$dotenv->load();

require_once $base . 'inc/functions.php';
require_once $base . 'inc/twig.php';
