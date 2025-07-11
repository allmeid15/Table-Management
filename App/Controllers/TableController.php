<?php

namespace App\Controllers;

use App\Models\Table;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Helpers\Session;


use \Core\Controller;
use \Core\View;

class TableController extends Controller 
{
    
   public function index()
{
    $tables = Table::orderBy('id', 'desc')->get();

    $sessionData = Session::getGlobals();

    $tableId = $_SESSION['table_id'] ?? null;
    $userId = $_SESSION['user_id'] ?? null;
    
    $products = Product::all();
    $user = null;
    if($userId) {
        $user = User::find($userId);
    } else {
        var_dump("allo");
    }

    if($tableId && $userId) {

        $order = Order::where('table_id', $tableId)
        ->where('user_id', $userId)
        ->where('status', 'open')
        ->first();
    }

    $route_params = [
        'table_id' => $_SESSION['table_id'] ?? null,
        'user_id' => $_SESSION['user_id'] ?? null,
    ];

    if (!$order) {
        $orderController = new OrderController($route_params);
        $orderController->createOrContinueOrder($tableId, $userId);
        $order = Order::where('table_id', $tableId)->where('status', 'open')->first();
    }

    View::renderTemplate('Tables/Index.html', [
        'user_id' => $sessionData['session']['user_id'] ?? null,
        'user_role' => $sessionData['session']['user_role'] ?? null,
        'products' => $products,
        'order' => $order,
        'tables' => $tables,
        'table_id' => $tableId,
        'user' => $user
    ]);
}


    public function create()
    {
        $sessionData = Session::getGlobals();

        $users = User::orderBy('first_name')->with('role')->get();

        View::renderTemplate('Tables/Create.html',[
        'user_id' => $sessionData['session']['user_id'] ?? null,
        'user_role' => $sessionData['session']['user_role'] ?? null,
        'users' => $users,
        ]);
    }


public function store()
{
    $data = array_map(function ($value) {
    return trim($value) === '' ? null : $value;
}, $_POST);

    extract($data);// secili key bohet variabel nvete 
    if(empty($user_id)){
        $data['user_id'] = null;
    };    

    $data = compact('name', 'user_id', 'order_id', 'status');

    Table::create($data);

    header('Location: /tables');
}

public function setTableSession() 
{
    $data = json_decode(file_get_contents('php://input'), true);
    $tableId = $data['table_id'] ?? null;

    if ($tableId) {
        $_SESSION['table_id'] = $tableId;
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing table_id']);
    }
}
}