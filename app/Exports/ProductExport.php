<?php

namespace App\Exports;

use App\Models\GadgetModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GadgetModel::all();  // This will fetch all the event data
    }
}
