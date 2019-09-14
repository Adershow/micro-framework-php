<?php
$router = new Router(new Request);
/*
Here you put your routes
Examples down below
 */
$router->get('/profile/domain/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('profile', 'domain', $data);
});
$router->post('/profile/postTest', function ($req) {
    $data = $req->getBody();
    Router::redirect('profile', 'postTest', $data);
});
$router->put('/profile/putTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('profile', 'putTest', $data);
});
$router->patch('/profile/patchTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('profile', 'patchTest', $data);
});
$router->delete('/profile/deleteTest/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('profile', 'deleteTest', $data);
});

$router->defaultRequestHandler();
