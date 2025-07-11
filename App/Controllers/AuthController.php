<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\User;
use \Core\View;
use \Core\Controller;


class AuthController extends Controller
{


    public function login()
    {
        View::renderTemplate('Login.html');
    }


    public function loginStore()
    {

        $code = $_POST['code'] ?? null;

        if(!$code) {
            Session::get_instance() -> message('Code required');
            header('Location: /login');
            exit;
        }

        $session = Session::getInstance();
        $user = User::where('code', $code)->first();
        if($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->role_id;
            $session->login($user);
            //var_dump($_SESSION);
           //exit;
            //dd($_SESSION);

            $role = $user->role_id;
            if($role === 1) {
                $session->login($user);
                header('Location: /Dashboard');
                exit;
            } elseif($role === 2) {
                $session->login($user);
                //dd($role);
                header('Location: /tables');
                exit;
            }
        }else {
            $session->message('Invalid code');
        header('Location: /login');
        exit;
    }

    }

    public function logout() 
    {
        $session = Session::getInstance();
        $session->logout();
        header('Location: /login');
        exit;
    }
}