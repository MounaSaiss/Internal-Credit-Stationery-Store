<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagerDashController extends Controller
{
    public function ViewManagerdash()
    {
       
        $manager = auth()->user();

        if (!$manager || $manager->role !== 'manager') {
            abort(403);
        }

       
        $employees = User::where('role', 'employee')
            ->where('department', $manager->department)
            ->select('id', 'name', 'department')
            ->get();

      
        return view('managerDashboard', compact('manager', 'employees'));
    }
}
