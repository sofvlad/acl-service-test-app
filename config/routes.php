<?php
declare(strict_types=1);

$router->middleware($container->get(\App\Middleware\OpenAPIMiddleware::class));

return $router->group('/api', function ($router) {
    // User
    $router->get('/users', 'App\Controller\User\AllAction');
    $router->get('/user/{id}', 'App\Controller\User\GetAction');
    $router->post('/user/{id}/add_roles', 'App\Controller\User\AddRolesAction');
    $router->post('/user/{id}/remove_roles', 'App\Controller\User\RemoveRolesAction');

    // Role
    $router->get('/roles', 'App\Controller\Role\AllAction');
    $router->get('/role/{id}', 'App\Controller\Role\GetAction');
    $router->post('/role/{id}/add_users', 'App\Controller\Role\AddRolesAction');
    $router->post('/role/{id}/remove_users', 'App\Controller\Role\RemoveRolesAction');
    $router->post('/role/{id}/add_permissions', 'App\Controller\Role\AddPermissionsAction');
    $router->post('/role/{id}/remove_permissions', 'App\Controller\Role\RemovePermissionsAction');

    // Permission
    $router->get('/permissions', 'App\Controller\Permission\AllAction');
    $router->get('/permission/{id}', 'App\Controller\Permission\GetAction');
    $router->post('/permission/{id}/add_roles', 'App\Controller\Permission\AddRolesAction');
    $router->post('/permission/{id}/remove_roles', 'App\Controller\Permission\RemoveRolesAction');
})->middleware($container->get(\App\Middleware\JsonMiddleware::class));
