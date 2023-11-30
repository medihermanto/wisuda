<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
    }

    public function index()
    {
        $roles = Role::latest()->when(request()->q, function ($roles) {
            $roles = $roles->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::latest()->get();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            return redirect()->route('admin.role.index')->with(['success' => 'Data Role Berhasil ditambahkan!']);
        } else {
            return redirect()->route('admin.role.index')->with(['error' => 'Data Role Gagal ditambahkan!']);
        }
    }
    public function edit(Role $role)
    {
        $permissions = Permission::latest()->get();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id
        ]);

        $role = Role::findOrFail($role->id);
        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions'));

        if ($role) {
            return redirect()->route('admin.role.index')->with(['success' => 'Data Role Berhasil diubah!']);
        } else {
            return redirect()->route('admin.role.index')->with(['error' => 'Data Role Gagal diubah!']);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();
        if ($role) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
