<?php

namespace App\Exports;

use App\Models\UserModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserModel::where('role', 'user')->get();
    }
    /**
     *@return array
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'password',
            'address',
            'role',
            'remember_token',
            'created_at',
            'updated_at'
        ];
    }
}
