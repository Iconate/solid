<?php

return [
    ['GET', '/test/{id}', ['App\Handlers\PageController', 'index']],
    ['GET', '/', ['App\Handlers\HomeController', 'index']]
];