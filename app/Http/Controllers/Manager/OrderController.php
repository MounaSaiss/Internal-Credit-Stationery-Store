<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
//  search about this 

class OrderController extends Controller
{
    public function waiting()
    {
        $manager = Auth::user();

        $orders = Order::with('user')
            ->where('status', 'pending')
            ->whereHas('user', function ($query) use ($manager) {
                $query->where('department', $manager->department);
            })
            ->get();

        return view('manager.orders_waiting', compact('orders'));
    }
    public function approve($id)
    {
        $manager = Auth::user();
        $order = Order::where('id', $id)
            ->whereHas('user', function ($query) use ($manager) {
                $query->where('department', $manager->department);
            })
            ->firstOrFail();

        $order->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Order approved successfully');
    }
    public function reject($id)
    {
        $manager = Auth::user();
        $order = Order::where('id', $id)
            ->whereHas('user', function ($query) use ($manager) {
                $query->where('department', $manager->department);
            })
            ->firstOrFail();
        $user = $order->user;
        $products = $order->products;
        $order->update(['status' => 'rejected']);
        $user->token += $order->total_price;
        $products->each(function ($product) use ($order) {
            $product->stock += $product->pivot->quantity;
            $product->save();
        });
        $user->save();

        return redirect()->back()->with('success', 'Order rejected successfully');
    }
}
