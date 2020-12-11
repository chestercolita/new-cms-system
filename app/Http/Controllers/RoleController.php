<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', ['roles' => Role::all()]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required','unique:roles']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        session()->flash('role-created-message', 'Role '. request('name') . ' was created!');
        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name')) {
            $role->save();
            $message = 'Role '. $role->name . ' was updated!';
        } else {
            $message = 'Nothing was updated!';
        }
        session()->flash('role-updated-message', $message);
        return redirect()->route('roles.index');
    }

    public function attach(Role $role)
    {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach(Role $role)
    {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('message', 'Role '. $role->name . ' was deleted!');
        return back();
    }

}
