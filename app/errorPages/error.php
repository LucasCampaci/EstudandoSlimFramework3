<?php
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration); //Create Your container


//Override the default Not Found Handler
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Erro 404');
    };
};

//Override the default Not Found Handler
$c['errorHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['response']
        ->withStatus(404)
        ->withHeader('Content-Type', 'text/html')
        ->write('Erro 500');
    };
};