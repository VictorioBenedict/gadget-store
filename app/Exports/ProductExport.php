<?php

namespace App\Exports;

use App\Models\GadgetModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GadgetModel::all();  // This will fetch all the event data
    }
    /**
     *@return array
     */
    public function headings(): array
    {
        return [
            'id',
            'image',
            'category',
            'name',
            'description',
            'price',
            'created_at',
            'updated_at'
        ];
    }
}
