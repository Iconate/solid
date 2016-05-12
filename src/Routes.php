<?php

return [
	['GET','/example/{id}', 'App\Handlers\HomeController', 'index', ['before' => 'auth']],
];

//return [
//    ['GET', '/test/{id}', ['App\Handlers\PageController', 'index']],
//    ['GET', '/', ['App\Handlers\HomeController', 'index']]
//];