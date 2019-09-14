<?php

//$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

//Defining the routes
//Router::route()

$router = new Router(new Request);

$router->get('/profile/domain/:id/:name', function ($req) {
    $data = $req->getBody();
    Router::redirect('profile', 'domain', $data);
});
