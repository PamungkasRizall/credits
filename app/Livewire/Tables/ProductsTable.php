<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;
    protected $index = 0;
    public $modal;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown()
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                $classes = [];

                if ($this->modal) {
                    $classes[] = 'text-xs+';
                }

                if (in_array($column->getField(), ['hpp', 'price'])) {
                    $classes[] = 'text-right';
                }

                return [
                    'class' => implode(' ', $classes),
                ];
            });

        if ($this->modal)
        {
            $this->setPaginationVisibilityDisabled()
                ->setColumnSelectDisabled()
                ->setPerPageVisibilityDisabled();
        }
    }

    public function builder(): Builder
    {
        return Product::with('merk', 'unit');
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Produk", "name")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {
                        if ($this->modal) {
                            return '<a class="text-primary" href="javascript:;" wire:click="$dispatch(\'selectedProduct\', { row: '. $row .' })">'. $value .'</a>';
                        }

                        return $value;
                    }
                )
                ->html(),
            Column::make("Merk", "merk.name")
                ->searchable()
                ->sortable(),
            Column::make("Tipe", "type")
                ->searchable()
                ->sortable(),
            Column::make("HPP", "hpp")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => currency($value)
                ),
            Column::make("Harga", "price")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => currency($value)
                ),
            Column::make("Unit", "unit.name")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(
                    fn($value, $row, Column $column) => Carbon::make($value)->format('d/m/y H:i:s')
                )
                ->sortable(),
            Column::make('Actions', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'products-edit', 'canDelete' => 'products-delete'])->withValue($value)
                )
                ->hideIf(! auth()->user()->canAny(['products-edit', 'products-delete']) || $this->modal),
        ];
    }
}
