<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($rows as $row) {
            Producto::create([
                'nombre' => $row['nombre'],
                'precio' => $row['precio'],
                'stock' => $row['stock'],
                // ... otros campos
            ]);
        }
    }
}
