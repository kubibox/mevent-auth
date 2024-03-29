<?php

declare(strict_types=1);

use App\Register\Actions\ConfirmationEmailAction;
use App\Token\Actions\AuthTokenGenerateAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });


    $app->group('/api/v1', function (Group $group) {
        $group->post('/email-confirm', ConfirmationEmailAction::class);
        $group->post('/token/generate', AuthTokenGenerateAction::class);
    });
};
