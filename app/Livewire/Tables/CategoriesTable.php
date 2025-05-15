<?php

namespace App\Livewire\Tables;

use App\Services\CategoryService;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class CategoriesTable extends DataTableComponent
{
    protected $model = Category::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('type', 'asc')
            // ->setHideBulkActionsWhenEmptyEnabled()
            ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Tipe", "type")
                ->sortable(),
            Column::make("Tgl Dibuat", "created_at")
                ->format(
                    fn($value, $row, Column $column) => Carbon::make($value)->format('d/m/y H:i:s')
                )
                ->sortable(),
            Column::make('Aksi', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'categories', 'canDelete' => 'categories'])->withValue($value)
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Tipe')
                ->setFilterPillTitle('Tipe')
                ->options(
                        (new CategoryService)->getTypes()
                        ->put('', '-- All --')
                        ->sort()
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                        $builder->where('type', $value);
                }),
        ];
    }
}
