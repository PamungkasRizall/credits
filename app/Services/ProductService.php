<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public function findOrFail(string $id): Product
    {
        return Product::with('merk', 'unit')->findOrFail($id);
    }

    public function storeProduct(ProductDTO $dto): Product
    {
        return DB::transaction(function () use ($dto) {
            return Product::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function deleteProduct(string $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
