<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Shanghai');
    require  "../vendor/autoload.php";

$config['displayErrorDetails'] = true;
$config['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'ssl',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'ut8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => 'cc_',
];
session_start();

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../template/', [
        'cache' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};
$container['db'] = function($c){
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
$app->get('/', function (Request $req, Response $resp, $args) {
    return $this->view->render($resp,'default/index.html');
});
$app->group('/support',function()use($app){
        $app->get('/lists/{id:[0-9]+}',function(Request $req, Response $resp, $args){
            $id = (int)$args['id'];

        });
        $app->get('/page/{id:[0-9]+}',function(Request $req, Response $resp, $args){
            $id = (int)$args['id'];
            if($id == 0 ){
                return $resp->withStatus(404)->write('Page not find');;
            }

        });
});
$app->group('/user',function()use($app){
        $app->get('/{user_id:[0-9]+}',function(Request $req,Response $resp,$args){

        })->setName('user.info');
        
});
$app->group("/auth",function()use($app){
        $app->get('/login',function(Request $req, Response $resp, $args){
            return $this->view->render($resp,'default/Auth/login.html');
        })->setName('auth.login');
        $app->get('/register',function(Request $req, Response $resp, $args){
            return $this->view->render($resp,'default/Auth/register.html');
        })->setName('auth.register'); 
        $app->get("/changepassword",function(Request $req, Response $resp, $args){
            return $this->view->render($resp,'default/Auth/password.html');
        })->setName('auth.passwd');
});
$app->group('/api',function()use($app){
    $app->get('/cart',function(Request $req, Response $resp,$args){
        $cookies = $req->getCookieParams();
        return $resp->withJson($cookies);
    });
    $app->delete('/cart/{id:[0-9]+}',function(Request $req, Response $resp,$args){

    });
    $app->post('/cart',function(Request $req, Response $resp,$args){
        $data = $req->getParsedBody();

    });
    $app->get('/verify',function(Request $req, Response $resp, $args){
        
    });

});
$app->run();