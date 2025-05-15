<?php

namespace App\Services;

use App\DTOs\CategoryDTO;
use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function findOrFail(string $id): Category
    {
        return Category::findOrFail($id);
    }

    public function getCategories(string $type = null): Collection
    {
        return Category::when( $type, function ($q) use($type) {
                return $q->type($type);
            })
            ->pluck('name', 'id')
            ->sort();
    }

    public function getTypes(): Collection
    {
        $collect = collect(CategoryType::values())->mapWithKeys(function (CategoryType $item) {
            $value = $item->value;
            return [$value => $value];
        });

        return $collect;
    }

    public function storeCategory(CategoryDTO $dto): Category
    {
        return DB::transaction(function () use ($dto) {
            return Category::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function deleteCategory(string $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
