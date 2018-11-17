<?php

$data = [
    'assetpath' => dirname($_SERVER['PHP_SELF']),
];

echo $twig->render('web', compact('data'));
