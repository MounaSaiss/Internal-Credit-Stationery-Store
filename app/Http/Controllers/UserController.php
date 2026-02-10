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

    public function orders()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(2);

        return view('user.orders', compact('orders'));

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

    public function searchOrders($value)
    {
        return response()->json(
            Order::with('items')
                ->where('user_id', Auth::id())
                ->where('code', 'LIKE', "%{$value}%")
                ->get()
        );
    }

    public function searchPurchases($value)
    {
        return response()->json(
            Order::with(['items.product'])
                ->where('user_id', Auth::id())
                ->whereHas('items.product', fn($q) => $q->where('name', 'LIKE', "%{$value}%")
                )
                ->get()
        );
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

    public function settings(request $request)
    {
        $user = User::firstWhere('id', $request->userId);
        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->get();

        return view('user.profile-settings', compact('user', 'orders'));

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
        $request->validate(['name' => 'required', 'email' => 'unique:users,email|required', 'department' => 'required', 'role' => 'required']);
        $user->update($request->all());
        return redirect()->route('user.settings', ['userId' => $user->id]);

    }

    public function updatepass(Request $request, User $user)
    {
        if (password_verify($request->current_password, $user->password)) {
            $user->password = $request['new_password'];
            return redirect()->route('user.settings', ['userId' => $user->id]);
        } else {
            return redirect()->back()->with('error', 'The password is incorrect');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if (password_verify($request->password, $user->password)) {
            $user->delete();
            return redirect()->route('home', ['userId' => $user->id]);
        } else {
            return redirect()->back()->with('error', 'The password is incorrect');
        }
    }
}
