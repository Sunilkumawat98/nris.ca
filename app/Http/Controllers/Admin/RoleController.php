<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('manage-roles');

        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
}
