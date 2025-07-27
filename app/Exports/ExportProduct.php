<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Product;

class ExportProduct implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Product::select('id', 'ProductName', 'CategoryID','Qty','PriceBuy', 'PriceSell')->get();
    }

    public function headings(): array
    {
        return [
            'ລະຫັດ',
            'ຊື່ສິນຄ້າ',
            'ໝວດໝູ່',
            'ຈຳນວນ',
            'ລາຄາຊື້',
            'ລາຄາຂາຍ',
        ];
    }
}
