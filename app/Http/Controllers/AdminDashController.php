<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;



class AdminDashController extends Controller
{
    public function ViewAdmindash()
    {

        $orders = Order::with(['user:id,name,role', 'items.product:id,name,price',])->get();
        $ordersRow = [];

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $ordersRow[] = [
                    'id' => $order->user->id,
                    'Buyer Name' => $order->user->name,
                    'Product Name' => $item->product->name,
                    'Buyer Role' => $order->user->role,
                    'Quantity' => $item->quantity,
                    'Total Price' => $item->quantity * $item->product->price,
                    'Purchase Date' => $order->created_at
                ];
            }
        }

        return view('dashboard', compact('ordersRow'));
    }
}
