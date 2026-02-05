<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function waiting()
    {
        $orderItems = OrderItem::with([
            'product',
            'order.user'
        ])
            ->where('status', 'waiting')
            ->get();
        // dd($orderItems);
        return view('manager.orders_waiting', compact('orderItems'));
    }
    public function validateOrder(OrderItem $orderItem)
    {
        if ($orderItem->status !== 'waiting') {
            return back()->with('error', 'This order is already processed.');
        }

        $orderItem->update([
            'status' => 'validated',
        ]);

        return back()->with('success', 'Order validated successfully.');
    }
    public function refuseOrder(OrderItem $orderItem)
    {
        if ($orderItem->status !== 'waiting') {
            return back()->with('error', 'This order is already processed.');
        }

        $orderItem->update([
            'status' => 'refused',
        ]);

        return back()->with('success', 'Order refused successfully.');
    }
}
