<?php

$loader = new Twig_Loader_Array([
                                    'web' => file_get_contents($base . 'templates/web.twig'),
                                ]);

$twig = new Twig_Environment($loader, ['debug' => getenv('DEBUG', false)]);

$twig->addFunction(
    new Twig_Function('env', function ($var, $default = null) {
        return getenv($var, $default);
    })
);

$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addExtension(new Twig_Extension_Debug());
