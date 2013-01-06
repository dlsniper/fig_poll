<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpKernel\Debug\ErrorHandler;

ErrorHandler::register();

$appPath = __DIR__ . '/../app/';

$app = new Silex\Application();

if (!isset($_SERVER['HTTP_CLIENT_IP'])
    || !isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    $app['debug'] = true;
}

$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => $appPath . 'views/',
    )
);

$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array(
        'db.options' => array(
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__ . '/../db/fig_poll.sqlite',
        ),
    )
);

$app->mount('/', include $appPath . 'app.php');

$app->run();