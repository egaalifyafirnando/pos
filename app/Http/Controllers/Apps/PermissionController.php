<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // GET PERMISSIONS
        $permissions = Permission::when(request()->q, function ($permissions) {
            $permissions = $permissions->where('name', 'LIKE', '%' . request()->q . '%');
        })->latest()->paginate(5);

        // RETURN INERTIA VIEW
        return inertia('Apps/Permissions/Index', [
            'permissions' => $permissions
        ]);
    }
}
