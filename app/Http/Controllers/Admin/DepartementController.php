<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DepartementsImport;
use App\Models\Departement;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:departements.index|departement.create|department.edit|departement.delete');
    }

    public function index()
    {
        $departements = Departement::when(request()->q, function ($departements) {
            $departements = $departements->where('name', 'like', '%' . request()->q . '%')->orderBy('faculty_id', 'desc');
        })->paginate(10);
        return view('admin.departement.index', compact('departements'));
    }

    public function create()
    {
        $faculties = Faculty::latest()->get();
        return view('admin.departement.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'faculty_id' => 'required',
            'name' => 'required|unique:departements'
        ]);

        $departement = Departement::create([
            'faculty_id' => $request->input('faculty_id'),
            'name' => $request->input('name'),
        ]);

        if ($departement) {
            return redirect()->route('admin.departement.index')->with(['success' => 'Data Program Studi berhasil ditambahkan!']);
        } else {
            return redirect()->route('admin.departement.index')->with(['error' => 'Data Program Studi gagal ditambahkan!']);
        }
    }

    public function edit(Departement $departement)
    {
        $faculties = Faculty::latest()->get();
        return view('admin.departement.edit', compact('departement', 'faculties'));
    }

    public function update(Request $request, Departement $departement)
    {
        $this->validate($request, [
            'faculty_id' => 'required',
            'name' => 'required|unique:departements,name,' . $departement->id
        ]);
        $departement = Departement::findOrFail($departement->id);

        $departement->update([
            'faculty_id' => $request->input('faculty_id'),
            'name' => $request->input('name'),
        ]);

        if ($departement) {
            return redirect()->route('admin.departement.index')->with(['success' => 'Data Program Studi berhasil diubah!']);
        } else {
            return redirect()->route('admin.departement.index')->with(['error' => 'Data Program Studi gagal diubah!']);
        }
    }

    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);

        $departement->delete();

        if ($departement) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function import()
    {
        $departement = Excel::import(new DepartementsImport, request()->file('file'));

        if ($departement) {
            return redirect()->route('admin.departement.index')->with(['success' => 'Import Program Studi Berhasil!']);
        } else {
            return redirect()->route('admin.departement.index')->with(['error' => 'Import Program Studi Gagal!']);
        }
    }
}
