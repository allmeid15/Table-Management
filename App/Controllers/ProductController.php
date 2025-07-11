<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Helpers\Session;
use \Core\Controller;
use \Core\View;

class ProductController extends Controller 
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
        $sessionData = Session::getGlobals();

        $products = Product::with('category')->get();

        View::renderTemplate('Product/Index.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
            'products'=>$products
        ]);
    }

    public function create()
    {

        $sessionData = Session::getGlobals();

        $categories = Category::orderBy('name')->get();

        View::renderTemplate('Product/Create.html', [
            'user_id' => $sessionData['session']['user_id'] ?? null,
            'user_role' => $sessionData['session']['user_role'] ?? null,
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        Product::create($_POST);
        header('Location: /products');        
    }

    public function edit()
    {
        $product = Product::findOrFail($_GET['id']);

        View::renderTemplate('Product/Edit.html', ['product' => $product]);
    }

    public function update()
    {
        $product = Product::findOrFail($_POST['id']);
        $product->update($_POST);
        header('Location:/products');
    }

    public function destroy()
    {
        $product = Product::findOrFail($_GET['id']);
        $product->delete();

        header('Location: /products');
    }
}