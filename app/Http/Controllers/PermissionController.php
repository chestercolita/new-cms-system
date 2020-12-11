<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', ['permissions' => Permission::all()]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required','unique:permissions']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        session()->flash('permission-created-message', 'Permission '. request('name') . ' was created!');
        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($permission->isDirty('name')) {
            $permission->save();
            $message = 'Permission '. $permission->name . ' was updated!';
        } else {
            $message = 'Nothing was updated!';
        }
        session()->flash('permission-updated-message', $message);
        return redirect()->route('permission.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('message', 'Permission '. $permission->name . ' was deleted!');
        return back();
    }
}
