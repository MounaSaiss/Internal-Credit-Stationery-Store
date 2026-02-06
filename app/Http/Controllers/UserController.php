<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function profile(request $request)
    {
        $user = User::firstWhere('name', $request->username);
        $orders = Order::with(['items.product'])->where('user_id', $user->id)->get();

        return view('user.profile', compact('user', 'orders'));

    }
    public function purchases(Request $request)
    {
        $orders = collect();

        if ($request->filled('order_id')) {
            $order = Order::with('items.product')->where('code', $request->order_id)->first();
            if ($order) {
                $orders = collect([$order]);
            }
        } else {
            $user = User::firstWhere('name', $request->username);

            $orders = Order::with('items.product')->where('status', 'approved')->where('user_id', $user->id)->get();
        }

        return view('user.purchases', compact('orders'));
    }

    public function orders(request $request)
    {
        $user = User::firstWhere('name', $request->username);
        $orders = Order::with(['items.product'])->where('user_id', $user->id)->get();

        return view('user.orders', compact( 'orders'));

    }

    public function dashboard(request $request)
    {
        $user = User::firstWhere('name', $request->username);
        $ordertotal = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $recentOrders = Order::where('user_id', $user->id)->with('items.product')->latest()->take(3)->get();
        return view('user.dashboard', compact('user', 'ordertotal', 'pendingOrders', 'recentOrders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
