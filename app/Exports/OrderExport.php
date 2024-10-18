<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::all();  // This will fetch all the event data
    }
    /**
      *@return array
      */
    public function headings(): array
    {
        return [
            'ID',
            'User_ID',
            'Product_ID',
            'User_Name',
            'ProductName',
            'Quantity',
            'Price',
            'Status',
            'created_at',
            'updated_at'
        ];
    }
}
