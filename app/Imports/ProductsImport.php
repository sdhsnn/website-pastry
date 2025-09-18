<?php
namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    public function model(array $row)
    {
        return new Product([
            'title'       => $row[0],
            'description' => $row[1],
            'price'       => $row[2],
            'stock'       => $row[3],
            'image'       => $row[4] ?? null,
        ]);
    }
}
