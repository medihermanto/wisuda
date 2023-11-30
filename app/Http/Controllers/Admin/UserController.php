<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Departement;
use App\Models\Faculty;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.index|users.create|users.edit|roles.delete');
    }

    public function index()
    {
        $departements = Departement::latest()->get();
        $users = User::latest()->when(request()->q, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.user.index', compact('users', 'departements'));
    }

    public function import()
    {
        $user = Excel::import(new UsersImport, request()->file('file'));

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Import Users Berhasil!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Import Users Gagal!']);
        }
        return back();
    }

    public function create()
    {
        $faculties = Faculty::latest()->get();
        $departements = Departement::latest()->get();
        $roles = Role::latest()->get();
        return view('admin.user.create', compact('roles', 'departements', 'faculties'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'departement_id' => $request->input('departement_id'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRole($request->input('role'));

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data User berhasil ditambahkan!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data User gagal ditambahkan!']);
        }
    }

    public function getDepartement($id)
    {
        $data = Departement::where('faculty_id', $id)->get();
        return response()->json($data);
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        $faculties = Faculty::latest()->get();
        $departements = Departement::latest()->get();
        return view('admin.user.edit', compact('roles', 'user', 'faculties', 'departements'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
        ]);

        $user = User::findOrFail($user->id);

        if ($request->input('password') == "") {
            $user->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'departement_id' => $request->input('departement_id'),
            ]);
        } else {
            $user->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'departement_id' => $request->input('departement_id'),
                'password' => bcrypt($request->input('password')),
            ]);
        }

        $user->syncRoles($request->input('role'));

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data User berhasil diubah!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data User gagal diubah!']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
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
