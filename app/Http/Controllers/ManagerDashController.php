<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashController extends Controller
{
    public function viewManagerdash()
    {
        $manager = Auth::user();

        $employees = User::where('role', 'employee')
            ->where('department', $manager->department)
            ->withCount('orders')
            // ->select('id', 'name', 'department', 'email', 'role', 'token')
            ->get();

        return view('manager.managerDashboard', compact('manager', 'employees'));
    }
}
