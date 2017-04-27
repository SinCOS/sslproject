<?php
namespace App\Controllers\Auth;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


use App\Controllers;

class AuthController extends Controllers {

    public function postLogin(Request $req, Response $resp,$args){
        $data = $req->getParsedBody();

    }
    public function postReigster(Request $req, Response $resp, $args){
        $data = $req->getParsedBody();
    }
    public function postResetpasswd(Request $req, Response $resp , $args){
         $data = $req->getParsedBody();
         $password = md5($data['passwd']);
         
    }
    public function postConfirm(Request $req, Response $resp , $args){
         $data = $req->getParsedBody();
    }
}