<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(request $request)
    {
        $user = User::firstWhere('id', $request->userId);
        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->get();

        return view('user.profile', compact('user', 'orders'));

    }
    public function settings(request $request)
    {
        $user = User::firstWhere('id', $request->userId);
        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->get();

        return view('user.profile-settings', compact('user', 'orders'));

    }
    public function purchases(Request $request)
    {
        $orders = collect();

        if ($request->filled('order_id')) {
            $orders = Order::with('items.product')
                ->where('code', $request->order_id)
                ->paginate(2);
        } else {
            $orders = Order::with('items.product')
                ->where('status', 'approved')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(2);
        }


        return view('user.purchases', compact('orders'));
    }

    public function orders()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(2);

        return view('user.orders', compact( 'orders'));

    }
    public function search(Request $request, $value)
    {
        $query = Order::with(['items.product'])
            ->where('user_id', Auth::id());

        if ($request->type === 'orders') {
            // search by order code
            $query->where('code', 'LIKE', "%{$value}%");
        } else {
            // search by product name
            $query->whereHas('items.product', function ($q) use ($value) {
                $q->where('name', 'LIKE', "%{$value}%");
            });
        }

        return response()->json($query->get());
    }


    public function dashboard(request $request)
    {
        $user = User::firstWhere('id', $request->userId);
        $ordertotal = Order::where('user_id', $user->id)
            ->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')
            ->count();
        $recentOrders = Order::where('user_id', $user->id)
            ->orderBy('updated_at')
            ->with('items.product')
            ->latest()
            ->take(3)
            ->get();
        return view('user.dashboard', compact('user', 'ordertotal', 'pendingOrders', 'recentOrders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //gonna use this for comments
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //coments
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
        //profile
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
        //deleting account
    }
}
