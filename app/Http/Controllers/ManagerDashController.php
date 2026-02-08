<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ManagerDashController extends Controller
{
    public function ViewManagerdash()
    {
        $buyers = Order::with([
            'user:id,name,role,department',
            'items.product:id,name'
        ])
        ->whereHas('user', function ($q) {
            $q->where('role', 'employee');
        })
        ->get();

        $buyersRow = [];

        foreach ($buyers as $buy) {

            if (!$buy->user) continue;

            $userId = $buy->user->id;

            if (!isset($buyersRow[$userId])) {
                $buyersRow[$userId] = [
                    'id' => $buy->user->id,
                    'buyername' => $buy->user->name,
                    'role' => $buy->user->role,
                    'Products' => [],
                    'departement' => $buy->user->department,
                ];
            }

            foreach ($buy->items as $item) {
                $buyersRow[$userId]['Products'][] = [
                    'Product Name' => $item->product->name
                ];
            }
        }

        return view('managerDashboard', compact('buyersRow'));
    }
}
