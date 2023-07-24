<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('manage-permissions');

        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }
}
