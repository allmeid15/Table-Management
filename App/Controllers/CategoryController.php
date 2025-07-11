<?php

namespace App\Controllers;

use App\Helpers\Session;
use App\Models\Category;
use \Core\Controller;
use \Core\View;

class CategoryController extends Controller 
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
       $categories = Category::all();

       $sessionData = Session::getGlobals();
        
        View::renderTemplate('Category/Index.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
            'categories'=> $categories
        ]);
    }

    public function create()
    {
        $sessionData = Session::getGlobals();

        View::renderTemplate('Category/Create.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
        ]);
    }

    public function store()
    {
        Category::create($_POST);
        header('Location:/categories');
    }

    public function edit()
    {
        $category = Category::findOrFail($_GET['id']);
        
        View::renderTemplate('Category/Edit.html', ['category' => $category]);
    }

    public function update()
    {
        $category = Category::findOrFail($_POST['id']);

        $category->update($_POST);
        header('Location: /categories');
    }

    public function destroy()
    {
        $category = Category::findOrFail($_GET['id']);
        $category->delete();

        header('Location: /categories');
    }
}