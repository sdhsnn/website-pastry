<?php
namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Product::all()->map(function ($product) {
            return [
                'id'          => $product->id,
                'title'       => $product->title,
                'price'       => $product->price,
                'stock'       => $product->stock,
                'description' => strip_tags($product->description), // ✅ hilangkan <p>
                'created_at'  => $product->created_at,
                'updated_at'  => $product->updated_at,
            ];
        });
    }
}
