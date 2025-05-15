<?php

namespace App\Livewire\Tables;

use App\Models\SubDistrict;
use App\Services\CategoryService;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;
use App\Services\SubDistrictService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class SubDistrictsTable extends DataTableComponent
{
    protected $model = SubDistrict::class;
    protected $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->format(fn () => ++$this->index +  ($this->getPage() - 1) * $this->perPage),
            Column::make("Provinsi", "province_name")
                ->sortable(),
            Column::make("Kab/ Kota", "city_name")
                ->sortable(),
            Column::make("Kecamatan", "district_name")
                ->sortable(),
            Column::make("Desa/ Kelurahan", "sub_district_name")
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Kab/ Kota')
                ->setFilterPillTitle('Kab/ Kota')
                ->options(
                        (new SubDistrictService)->getCities()
                        ->put('', '-- All --')
                        ->sort()
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                        $builder->where('city_code', $value);
                }),
            SelectFilter::make('Kecamatan')
                ->setFilterPillTitle('Kecamatan')
                ->options(
                        (new SubDistrictService)->getDistricts()
                        ->put('', '-- All --')
                        ->sort()
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    if($value)
                        $builder->where('district_code', $value);
                }),
        ];
    }
}
