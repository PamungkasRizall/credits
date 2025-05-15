<?php

namespace App\Livewire\Tables;

use App\Models\Regional;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            // ->setHideBulkActionsWhenEmptyEnabled()
            ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Username')
                ->sortable()
                ->searchable(),
            Column::make('Phone')
                ->sortable()
                ->searchable(),
            Column::make('Kategori', 'category.name')
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->format(
                    fn($value, $row, Column $column) => Carbon::make($value)->format('d/m/y H:i:s')
                )
                ->sortable(),
            Column::make('Actions', 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'users-edit', 'canDelete' => 'users-delete'])->withValue($value)
                )
                ->hideIf(! auth()->user()->canAny(['users-edit', 'users-delete'])),
        ];
    }

    // public function filters(): array
    // {
    //     return [
    //         SelectFilter::make('Regional')
    //             ->setFilterPillTitle('Regional')
    //             ->options(
    //                 Regional::pluck('name', 'id')
    //                     ->put('', '-- All --')
    //                     ->sort()
    //                     ->toArray()
    //             )
    //             ->filter(function(Builder $builder, string $value) {
    //                 if($value)
    //                     $builder->where('regional.id', $value);
    //             }),
    //     ];
    // }
}
