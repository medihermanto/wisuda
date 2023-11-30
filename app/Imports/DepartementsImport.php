<?php

namespace App\Imports;

use App\Models\Departement;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DepartementsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Departement([
            'faculty_id' => $row['faculty_id'],
            'name' => $row['name']
        ]);
    }

    public function rules(): array
    {
        return [
            'faculty_id' => 'required',
            'name' => 'required|unique:departements',
        ];
    }
}
