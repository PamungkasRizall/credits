<?php

namespace App\Traits\Modals;

use App\Models\Product;

trait ShowModalProduct
{
    public ?String $productDesc = null;
    public ?Product $product = null;
    public ?string $product_id;
    public ?int $item_price;

    public function showModalProduct(): void
    {
        $this->dispatch('open-modal', modalKey: 'product');
    }

    public function selectedProduct($row): void
    {
        $this->product = $this->productService->findOrFail($row['id']);
        $this->productDesc = $this->product->name;
        $this->product_id = $this->product->id;
        $this->item_price = $this->product->price;

        if (method_exists($this,'updatedProduct'))
        {
            $this->updatedProduct();
        }

        $this->dispatch('close-modal');
    }
}

