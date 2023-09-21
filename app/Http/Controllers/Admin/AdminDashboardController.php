<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\Admin;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function showDashboard()
    {
        if(!auth()->user()->hasPermission('manage_dashboard'))
        {
            abort(404, 'You are not Authorised...');
        }

        

        $countries                          = Country::where('status', 1)->get();
        $adminCount                         = Admin::where('status', 1)->count();
        $userCount                          = User::where('status', 1)->count();

        return view('admin.dashboard', compact('adminCount', 'userCount', 'countries'));
    }

    

}
