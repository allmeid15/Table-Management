<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Helpers\Session;
use \Core\View;
use \Core\Controller;

class UserController extends Controller 
{

    public function __construct()
    {
        $session = Session::getInstance();
        if (!$session->isSignedIn()) {
            header('Location: /login');
        }
    }
    public function index()
    {
        $users = User::orderBy('id', 'desc')->with('role')->get();

        $sessionData = Session::getGlobals();

        View::renderTemplate('Users/Index.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
            'users'=> $users
        ]);
    }

    public function create()
    {

        $sessionData = Session::getGlobals();
        View::renderTemplate('Users/Create.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
        ]);
    }
    
    public function store()
    {
        User::create($_POST);
        header('Location: /users');
    }

    public function edit() 
    {
        $sessionData = Session::getGlobals();
        $user = User::findOrFail($_GET['id']);

        View::renderTemplate('Users/Edit.html', [
            'user' => $user,
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
        ]);
    }

    public function update() 
    {
        $user = User::findOrFail($_POST['id']);
        $user->update($_POST);
        header('Location: /users');
    }

    public function destroy()
    {
        $user = User::findOrFail($_GET['id']);
        $user->delete();

        header('Location: /users');
    }

    
    


}