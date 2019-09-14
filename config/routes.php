<?php
$router = new Router(new Request);
/*
Here you put your routes
Examples down below
 */
$router->get('/index/domain/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('index', 'domain', $data);
});
$router->post('/index/postTest', function ($req) {
    $data = $req->getBody();
    Router::redirect('index', 'postTest', $data);
});
$router->put('/index/putTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('index', 'putTest', $data);
});
$router->patch('/index/patchTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('index', 'patchTest', $data);
});
$router->delete('/index/deleteTest/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('index', 'deleteTest', $data);
});

$router->defaultRequestHandler();
