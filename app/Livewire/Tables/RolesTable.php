<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RolesTable extends DataTableComponent
{
    protected $model = Role::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make(__('No.'), 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Name", "name")
                ->sortable(),
            Column::make('Permissions')
                ->label(fn($row) => limitText($row->permissions->pluck('name')->implode(', '), 90)),
            Column::make(__('Actions'), 'id')
                ->format(
                    fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'roles-edit', 'canDelete' => 'roles-delete'])->withValue($value)
                )
                ->hideIf(! auth()->user()->canAny(['roles-edit', 'roles-delete'])),
        ];
    }
}
