<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagerDashController extends Controller
{
    public function ViewManagerdash()
    {
        $managers = User::where('role', 'manager')
            ->select('id', 'name', 'department')
            ->get();

        $managersData = [];

        foreach ($managers as $manager) {

            $employees = User::where('role', 'employee')
                ->where('department', $manager->department)
                ->select('id', 'name', 'department')
                ->get();

            $managersData[] = [
                'manager_id' => $manager->id,
                'manager_name' => $manager->name,
                'department' => $manager->department,
                'employees' => $employees
            ];
        }

        return view('managerDashboard', compact('managersData'));
    }
}
