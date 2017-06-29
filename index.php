<?php

define("_APP", dirname(__FILE__) . '/app');


require_once 'vendor/autoload.php';
require_once _APP . '/errorPages/error.php';

$app = new Slim\App($c);


// Fetch DI Container
$container = $app->getContainer();

// Register JSON View helper
$container['view'] = function ($c) {
    return new \Slim\Views\JsonView();
};

$app->get('/hello/{name}', function ($request, $response, $args) {
        return $response->write("Hello, " . $args['name']);
});

$app->get('/teste/{name}', function ($request, $response) {
    return $response->write("O Teste informado é: " . $request->getAttribute('name'));
});

$app->get('/{op}/{num1}/{num2}', function ($request, $response, $args) {
    switch ($args['op']) {
        case 'somar':
            $res = "O resultado da soma é: ".($args['num1'] + $args['num2']);
            break;
        
        case 'subtrair':
            $res = "O resultado da subtração é: ".($args['num1'] - $args['num2']);
            break;
        
        case 'dividir':
            $res = "O resultado da divisão é: ".($args['num1'] / $args['num2']);
            break;
        
        case 'multiplicar':
            $res = "O resultado da multiplicação é: ".($args['num1'] * $args['num2']);  
            break;

        default:
            $res = "Operação inválida"; 
            break;
    } 
         return $this->view->render($response, [
        'results' => $res
    ], 401);
});

$app->run();