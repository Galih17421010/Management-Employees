<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Tables\Users;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

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
        return view('admin.users.create');
       
    }

    
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        Splade::toast('User success created')->autoDismiss(3);

        return to_route('admin.users.index');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
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
