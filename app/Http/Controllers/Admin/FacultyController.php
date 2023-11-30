<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DepartementsImport;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:faculties.index|faculties.create|faculties.edit|faculties.delete');
    }

    public function index()
    {
        $faculties = Faculty::latest()->when(request()->q, function ($faculties) {
            $faculties = $faculties->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.faculty.index', compact('faculties'));
    }

    public function create()
    {
        return view('admin.faculty.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:faculties'
        ]);

        $faculties = Faculty::create([
            'name' => $request->input('name')
        ]);

        if ($faculties) {
            return redirect()->route('admin.faculty.index')->with(['success' => 'Data Fakultas berhasil ditambahkan!']);
        } else {
            return redirect()->route('admin.faculty.index')->with(['error' => 'Data Fakultas gagal ditambahkan!']);
        }
    }

    public function edit(Faculty $faculty)
    {
        return view('admin.faculty.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $this->validate($request, [
            'name' => 'required|unique:faculties,name,' . $faculty->id
        ]);

        $faculties = Faculty::findOrFail($faculty->id);
        $faculties->update([
            'name' => $request->input('name')
        ]);
        if ($faculties) {
            return redirect()->route('admin.faculty.index')->with(['success' => 'Data Fakultas berhasil diubah!']);
        } else {
            return redirect()->route('admin.faculty.index')->with(['error' => 'Data Fakultas gagal diubah!']);
        }
    }

    public function destroy($id)
    {
        $faculties = Faculty::findOrFail($id);
        $faculties->delete();
        if ($faculties) {
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