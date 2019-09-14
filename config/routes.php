<?php
$router = new Router(new Request);

$router->get('/profile/domain/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('profile', 'domain', $data);
    exit;
});
$router->post('/profile/postTest', function ($req) {
    $data = $req->getBody();
    Router::redirect('profile', 'postTest', $data);
    exit;
});
$router->put('/profile/putTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('profile', 'putTest', $data);
    exit;
});
$router->patch('/profile/patchTest/:id', function ($req) {
    $data = $req->getBody();
    $data = array_merge($data, $req->getQueryParams());
    Router::redirect('profile', 'patchTest', $data);
    exit;
});
$router->delete('/profile/deleteTest/:id', function ($req) {
    $data = $req->getQueryParams();
    Router::redirect('profile', 'deleteTest', $data);
    exit;
});

$router->defaultRequestHandler();
