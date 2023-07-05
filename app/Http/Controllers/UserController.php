<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Tables\Users;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
   
    public function index()
    {
        return view('admin.users.index', [
            'users' => Users::class
        ]);
    }

    
    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::pluck('name', 'id')->toArray(),
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
       
    }

    
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        Splade::toast('User success created')->autoDismiss(3);

        return to_route('admin.users.index');
    }

    
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'roles' => Role::pluck('name', 'id')->toArray(),
            'permissions' => Permission::pluck('name', 'id')->toArray(),
            'user' => $user
        ]);
    }

    
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        
        Splade::toast('User success updated')->autoDismiss(3);

        return to_route('admin.users.index');
    }

    
    public function destroy(User $user)
    {
        $user->delete();
        Splade::toast('User deleted')->autoDismiss(3);

        return back();

    }
}
