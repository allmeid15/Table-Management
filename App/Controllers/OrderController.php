<?php

namespace App\Controllers;

use App\Models\Table;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\User;
use \Core\Controller;
use \Core\View;

class OrderController extends Controller
{
    public function index() 
    {
        $orders = Order::all();

        View::renderTemplate('Order/Index.html', ['orders'=>$orders]);
    }

    public function create()
    {
        View::renderTemplate('Order/Create.html');
    }

    public function store()
    {
        //dd($_POST);
        Order::create($_POST);
        header('Location:/orders');
    }

    public function createOrContinueOrder($tableId, $userId)
    {
        $order = Order::where('table_id', $tableId) 
        ->where('status', 'open')
        //->where('user_id', $userId)
        ->first();

        if (!$order) {

            $order = Order::create([
            'table_id' => $tableId,
            'status' => 'open',
            'user_id' => $userId
            ]);

            //return $order;
            $orderId = $order->id;
            
            View::renderTemplate('Tables/Index.html', [
                'order_id' => $orderId,
                'products' => Product::all()
            ]);
        }
    }


    public function submit() 
    {

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $tableId = $_SESSION['table_id'] ?? null;
        if (!$tableId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'No table in session']);
        return;
    }


        $userId = $_SESSION['user_id'] ?? null ;

        $items = $data ['items'];

        //$tableId = $data ['table_id'];

        // $userId = $data ['user_id'];

        $order = Order::where('table_id', $tableId)
                        ->where('user_id', $userId)
                        ->where('status', 'open')
                        ->first();
        if($order) {

            foreach ($items as $item ) {
            Order_Detail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
            $order->status = 'closed';
            $order->save();

            echo json_encode(['success' => true, 'message' =>'Order submitted and closed']);
        } else {
            echo json_encode (['success'=> false, 'message' => 'No open order found']);
        }

        //$orderId = $data['order_id'];
        }
        

    public function save()
    {
        $userId = $_SESSION['user_id'];
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $items = $data['items'] ?? null;

        if (!$items || !is_array($items)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'No items provided']);
            return;
    }

        $tableId = $_SESSION['table_id'] ?? null;
        if (!$tableId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'No table in session']);
        return;
    }

    $order = Order::where('table_id', $tableId)
                    ->where('user_id', $userId)
                    ->where('status', 'open')
                    ->first();

    if(!$order) {
        $order = Order::create([
            'table_id' => $tableId,
            'user_id' => $userId,
            'status' => 'open'
        ]);
    }

        foreach ($items as $item) {

            $orderDetail = Order_Detail::where('order_id', $order->id)
                                        ->where('product_id', $item['product_id'])
                                        ->first();
            if($orderDetail) {
                $orderDetail->quantity += $item['quantity'];
                $orderDetail->price = $item['price'];
                $orderDetail->save();
            } else {  
                Order_Detail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
}

    }

    public function getOpenOrder() 
    {
        $tableId = $_SESSION['table_id'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        if(!$tableId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing table_id']);
            return;
        }

        $order = Order::orderBy('id', 'desc')->where('table_id', $tableId)->where('user_id', $userId)
        ->where('status', 'open')
        ->with('orderDetails.product')
        ->first();

        if(!$order) {
            echo json_encode(['success' => true, 'order_id' => null, 'items'=>[]]);
            return;
        }

        $items = collect($order->orderDetails)->map(function ($item) {
            return [
                'product_id' =>$item->product_id,
                'name' => $item->product->name ?? '',
                'price' => $item->price,
                'quantity' => $item->quantity,
            ];
        });

        echo json_encode([
            'success' => true,
            'order_id' => $order->id,
            'items' => $items
        ]);
    }

}