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
    'password' => '',
    'charset' => 'utf8',
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
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = $capsule;
$app->get('/', function (Request $req, Response $resp, $args) {
    return $this->view->render($resp, 'default/index.html');
});
$app->group('/support', function () use ($app) {
        $app->get('/lists/{id:[0-9]+}', function (Request $req, Response $resp, $args) {
            $id = (int)$args['id'];
        });
        $app->get('/page/{id:[0-9]+}', function (Request $req, Response $resp, $args) {
            $id = (int)$args['id'];
            if ($id == 0) {
                return $resp->withStatus(404)->write('Page not find');
                ;
            }
        });
});
$app->group('/user', function () use ($app) {
        $app->get('/{user_id:[0-9]+}', function (Request $req, Response $resp, $args) {
        })->setName('user.info');
        $app->get('/order/list', function (Request $req, Response $resp, $args) {
            return $resp;
        })->setName('user.order.list');
});
function islogin(Request $req, Response  $resp, $next)
{
    if (isset($_SESSION['user.id'])) {
          return $resp->withStatus(302)->withHeader('Location', "/");
    }
}
$app->group("/auth", function () use ($app) {
        $app->get('/login', function (Request $req, Response $resp, $args) {
            return $this->view->render($resp, 'default/Auth/login.html');
        })->setName('auth.login');
        $app->get('/register', function (Request $req, Response $resp, $args) {
            return $this->view->render($resp, 'default/Auth/register.html');
        })->setName('auth.register');
        $app->get("/reset-passwd", function (Request $req, Response $resp, $args) {
            return $this->view->render($resp, 'default/Auth/password.html');
        })->setName('auth.passwd');
        $app->post('/login', '\App\Controllers\Auth\AuthController:postLogin');
        $app->post('/register', '\App\Controllers\Auth\AuthController:postRegister');
})->add(function (Request $req, Response  $resp, $next) {
    if (isset($_SESSION['user.id'])) {
          return $resp->withStatus(302)->withHeader('Location', "/");
    }
    return  $next($req, $resp);
});

$app->group('/api', function () use ($app) {
    $app->get('/check_user', function (Request $req, Response $resp, $args) {
        $data = $req->getQueryParams();
        $user = \App\Model\UserModel::where('username', $data['username'])->find(1);
        if (!$user || !$user->id) {
            return $resp->withHeader('Content-type', 'application/json')->withJson([
                'status' => 200,
                'message' => 'ok'
            ], 200);
        }
        return $resp->withHeader('Content-type', 'application/json')->withJson([
            'status' => 404,
            'message' => 'alreay exists',
        ], 404);
    });
    $app->post('/order', function (Request $req, Response $resp, $args) {
        $data = $req->getParsedBody();
        $good_id = (int)$data['good_id'];
        $years = (int)$data['years'];
        
        return $resp;
    });
    $app->get('/cart', function (Request $req, Response $resp, $args) {
        $cookies = $req->getCookieParams();
        return $resp->withJson($cookies);
    });
    $app->delete('/cart/{id:[0-9]+}', function (Request $req, Response $resp, $args) {
    });
    $app->post('/cart', function (Request $req, Response $resp, $args) {
        $data = $req->getParsedBody();
    });
    $app->get('/info', function (Request $req, Response $resp, $args) {
        phpinfo();
    });
    $app->get('/verify', function (Request $req, Response $resp, $args) {
        
    });
});
$app->run();
