<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Product;

class ImportProduct implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) {
            Product::create([
                'ProductName' => $row['product_name'],
                'CategoryID' => $row['category_id'],
                'ImagePath' => null,
                'Qty' => (int)$row['qty'],
                'PriceBuy' => (int)$row['price_buy'],
                'PriceSell' => (int)$row['price_sell'],
            ]);
        }
    }
}
