<?php
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/users', 'get_all_users_handler');
//    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');

//    $r->addRoute('GET', '/index', 'UsersController@login');
    $r->addRoute('GET', '/', 'PagesController@home');
    $r->addRoute('DELETE', '/delete/{id:\d+}', 'PagesController@delete');
    $r->addRoute('POST', '/add-post', 'PagesController@add');
    $r->addRoute('PUT', '/changeFavorite', 'PagesController@changeFavorite');
    $r->addRoute('GET', '/getContent', 'PagesController@getContent');
    $r->addRoute('GET', '/blog', 'PagesController@article');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        die("not found");
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        die("not allowed");
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (strpos($handler, "@")) {
            $exp = explode("@", $handler);
            $controller_name = $exp[0];
            if (!empty($exp[1])) {
                $function_name = $exp[1];
            }
        }
        $c = new $controller_name($pdo);
        if(!empty($vars)) {
            //die(var_dump("dxsc"));
            $c->{$function_name}($vars['id']);
        }
        else {
            $c->{$function_name}();
        }
        // ... call $handler with $vars
        break;
}