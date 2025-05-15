<?php

namespace App\Livewire\Tables;

use App\Enums\ReceivablesRegistrationStatus;
use App\Models\ReceivablesRegistration;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ReceivablesRegistrationTable extends DataTableComponent
{
    protected $model = ReceivablesRegistration::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('receivables_registrations.created_at', 'desc')
            ->setFilterLayoutSlideDown()
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                $attributes = [
                    'class' => '',
                ];

                if ($column->isField('bill_per_day'))
                    $attributes['class'] = $attributes['class'] .' text-right';

                return $attributes;
            });
    }

    public function builder(): Builder
    {
        return ReceivablesRegistration::select('receivables_registrations.id')->with('product', 'consumer');
    }

    public function columns(): array
    {
        return [
            // Column::make('#', 'id')
            //     ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Kode", "reg_code")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {
                        return '<button wire:click="$dispatch(\'show\', { id: \''. $row->id .'\' })" class="btn text-primary">
                                <span>'. $value .'</span>
                            </button>';
                    }
                )
                ->html(),
            Column::make("Kosumen", "consumer.name")
                ->searchable()
                ->sortable(),
            Column::make("Produk", "product.name")
                ->searchable()
                ->sortable(),
            Column::make("Tenor")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => $value . ' Hari'
                ),
            Column::make("Angsuran per hari", "bill_per_day")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => currency($value)
                ),
            Column::make("Status")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value) {
                        $color = $value->coloringClasses();

                        return '<div class="badge bg-'. $color .'/10 text-'. $color .' dark:bg-'. $color .'/15">
                                    '. $value->naming() .'
                                </div>';
                    }
                )
                ->html(),
            Column::make("Tgl dibuat", "created_at")
                ->format(
                    fn($value, $row, Column $column) => Carbon::make($value)->format('d/m/y H:i:s')
                )
                ->sortable(),
            // Column::make('Actions', 'id')
            //     ->format(
            //         fn($value, $row, Column $column) => view('components.partials.table-actions', ['canEdit' => 'products-edit', 'canDelete' => 'products-delete'])->withValue($value)
            //     )
            //     ->hideIf(! auth()->user()->canAny(['products-edit', 'products-delete']) || $this->modal),
        ];
    }
}
