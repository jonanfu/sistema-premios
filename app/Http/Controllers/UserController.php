<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->update(['passowrd' => Hash::make($request->password)]);
        $user->roles()->sync($request->get(role));
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $total_purchases = 0;
        foreach($user->sales as $key => $purchase)
        {
            $total_amount_sold = $purchase->total;
        }
        $total_amount_sold = 0;
        foreach($user->purchases as $key=> $purchase)
        {
            $total_amount_sold = $purchase->total;
        }
        return view('admin.user.show', compact('user', 'total_purchases', 'total_amount_sold'));
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if($user-> id == 1)
        {
            return redirect()->route('users.index');
        } else {
            $user->update($request->all());
            $user->roles()->sync($request->get('roles'));
            return redirect()->route('users.index');
        }
    }

    public function destroy(User $user)
    {
        if($user->id == 1)
        {
            return back();
        } else {
            $user->delete();
            return back();
        }
    }

}
