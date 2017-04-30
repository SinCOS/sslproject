<?php
namespace App\Controllers\Auth;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


use App\Controllers\Controller;

class AuthController extends Controller
{

    public function postLogin(Request $req, Response $resp, $args)
    {
        $data = $req->getParsedBody();
         $user = \App\Model\UserModel::where('username', $data['username'])->find(1);
         if ($user && $user->passwd == md5($data['passwd'])) {
            $_SESSION['user.id'] = $user->id;
            return $resp->withStatus(302)->withHeader('Location', "/");
        } else {
            echo 'fail!';
        }
    }
    public function postRegister(Request $req, Response $resp, $args)
    {
        $data = $req->getParsedBody();
        $this->view->render($resp,'default/Auth/register.html');
       // $user = \App\Model\UserModel;
        
        if ($data['passwd'] == $data['repasswd']) {
            $user = \App\Model\UserModel::create([
                'username' => $data['username'],
                'passwd' => md5($data['passwd']),
                'email' => '790407626@qq.com'
            ]);
            if($user && $user->id > 0 ){
                $_SESSION['user.id'] = $user->id;
            }
           // return $resp->withStatus(302)->withHeader('Location', "/");
        } else {
            echo 'fail!';
        }
    }
    public function postResetpasswd(Request $req, Response $resp, $args)
    {
         $data = $req->getParsedBody();
         $password = md5($data['passwd']);
    }
    public function postConfirm(Request $req, Response $resp, $args)
    {
         $data = $req->getParsedBody();
    }
}
