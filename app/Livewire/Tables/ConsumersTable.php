<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Consumer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ConsumersTable extends DataTableComponent
{
    protected $model = Consumer::class;
    protected $index = 0;
    public $modal;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('consumers.name', 'asc')
            ->setFilterLayoutSlideDown()
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                $attributes = [
                    'class' => ($this->modal) ? 'text-xs+' : '',
                ];

                return $attributes;
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
        return Consumer::select('consumers.sub_district_code')->with('subDistrict', 'lastTransaction');
    }

    public function columns(): array
    {
        return [
            Column::make(__('#'), 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Nama", "name")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {
                        if ($this->modal && !$row->lastTransaction) {
                            return '<a class="text-primary" href="javascript:;" wire:click="$dispatch(\'selectedConsumer\', { row: '. $row .' })">'. $value .'</a>';
                        }

                        return $value;
                    }
                )
                ->html(),
            Column::make("NIK", "nik")
                ->searchable()
                ->sortable(),
            Column::make("Usia", "date_of_birth")
                ->format(
                    fn($value, $row) => Carbon::parse($row->date_of_birth)->age
                )
                ->sortable(),
            Column::make("Kecamatan", "subDistrict.district_name")
                ->searchable()
                ->sortable(),
            Column::make("Kelurahan", "subDistrict.sub_district_name")
                ->searchable()
                ->sortable(),
            Column::make("Radius", "radius")
                ->searchable()
                ->sortable(),
            Column::make("Status Piutang Terakhir", "name")
                ->searchable()
                ->sortable()
                ->format(
                    function ($value, $row) {

                        if ($row->lastTransaction)
                        {
                            $status = $row->lastTransaction->status;
                            $color = $status->coloringClasses();

                            return '
                            <div class="badge bg-'.$color.'/10 text-'.$color.' dark:bg-'.$color.'/15">
                                '.$status->naming().'
                            </div>';
                        } else {
                            return '<div class="badge bg-navy-700 text-white dark:bg-navy-900">
                                Belum Pernah Piutang
                            </div>';
                        }
                    }
                )
                ->html(),
            Column::make("Created at", "created_at")
                ->format(
                    fn($value) => Carbon::make($value)->format('d/m/Y H:i:s')
                )
                ->sortable(),
        ];
    }
}
