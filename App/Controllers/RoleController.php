<?php

namespace App\Controllers;

use App\Models\Role;
use \Core\View;
use \Core\Controller;

class RoleController extends Controller
{
    public function index() 
    {
        $roles = Role::all();

        View::renderTemplate('Roles/Index.html', ['roles'=>$roles]);
    }

    public function create() 
    {
        View::renderTemplate('Roles/Create.html');
    }

    public function store() 
    {
        Role::create($_POST);
        header('Location: /roles');

    }
}