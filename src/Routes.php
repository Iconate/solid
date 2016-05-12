<?php

return [
	['GET','/example/{id}', 'App\Handlers\HomeController', 'index', ['before' => 'auth']],
];
