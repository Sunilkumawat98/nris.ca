<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function showDashboard()
    {
        if(!auth()->user()->hasPermission('manage_dashboard'))
        {
            abort(404, 'You are not Authorised...');
        }
        return view('admin.dashboard');
    }

    

}
