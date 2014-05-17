<?php
define('PATH_ROOT', dirname(__DIR__));
define('PATH_PUBLIC', PATH_ROOT . '/public');
define('PATH_SRC', PATH_ROOT . '/src');
define('PATH_VENDOR', PATH_ROOT . '/vendor');
define('PATH_VIEWS', PATH_SRC . '/views');

require_once PATH_VENDOR . '/autoload.php';
require_once PATH_SRC . '/config/production.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use library\View;

// starting app
$app = new Silex\Application();

if (DEBUG) {
    error_reporting(E_ALL);
    $app['debug'] = true;
} else {
    error_reporting(0);
    $app['debug'] = false;
}

// setup controllers
$app->mount('/', new controller\ContentController());

// setup error handling
$app->error(function(\Exception $e, $code) {
    if (DEBUG) {
        return;
    }
    $page = ($code === 404) ? 'error_404' : 'error_500';
    return new Response(View::render($page));
});

Request::enableHttpMethodParameterOverride();
$app->run();