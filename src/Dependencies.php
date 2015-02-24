<?php

$injector = new \Auryn\Provider;

/**
 * HTTP objects are shared because there would not be much point in adding content to
 * one object and then returning another one. So by sharing it you always get the same instance.
 */
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpResponse');


$injector->alias('App\Template\Renderer', 'App\Template\TwigRenderer');
$injector->alias('App\Template\FrontendRenderer', 'App\Template\FrontendTwigRenderer');

$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/assets/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

return $injector;