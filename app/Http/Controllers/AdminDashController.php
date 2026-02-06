<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;



class AdminDashController extends Controller
{
    public function ViewAdmindash(){
         
    $orders = Order::with(['user:id,name,role','items.product:id,name,price',])->get();
$ordersRow = [];

foreach ($orders as $order) {
    $userId = $order ->user->id;
    if (!isset($ordersRow[$userId])) {
         $ordersRow [$userId] = [
            'id'=>$order->user->id,
            'Buyer Name'=> $order->user->name,
            'Products'=> [],
            'Total Price'=>0,
            'Buyer Role'=>$order->user->role,
            'Purchase Date'=>$order->created_at
        ]; 
    }
    $total=0;

    foreach ($order->items as $item) {
        $ordersRow[$userId] ['Products'] [] = [
            'Product Name'=>$item->product->name,
            'Prices'=>$item->product->price,
            'Quantity'=>$item->quantity,
            // 'Subtotal'=>$item->quantity *$item->product->price,
            $total = ($item->quantity * $item->product->price)
        ];
        $ordersRow[$userId] ['Total Price'] += $total;
    }
}
     return view ('dashboard' , compact('ordersRow'));

    }

}


   