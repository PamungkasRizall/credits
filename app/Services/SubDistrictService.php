<?php

namespace App\Services;

use App\Models\SubDistrict;
use Illuminate\Support\Collection;

class SubDistrictService
{
    public function findOrFailBySubDistrict(int $code): SubDistrict
    {
        return SubDistrict::where('sub_district_code', $code)->firstOrFail();
    }

    public function getProvinces(): Collection
    {
        return SubDistrict::groupBy('province_code')->pluck('province_name', 'province_code');
    }

    public function getCities(int $provinceCode = null): Collection
    {
        return SubDistrict::when($provinceCode, function ($query) use($provinceCode) {
                                return $query->where('province_code', $provinceCode);
                            })
                            ->groupBy('city_code', 'city_name')
                            ->pluck('city_name', 'city_code')
                            ->sort();
    }

    public function getDistricts(int $cityCode = null): Collection
    {
        return SubDistrict::when($cityCode, function ($query) use($cityCode) {
                                return $query->where('city_code', $cityCode);
                            })
                            ->groupBy('district_code', 'district_name')
                            ->pluck('district_name', 'district_code')
                            ->sort();
    }

    public function getSubDistricts(int $districtCode = null): Collection
    {
        return SubDistrict::when($districtCode, function ($query) use($districtCode) {
                                return $query->where('district_code', $districtCode);
                            })
                            ->groupBy('sub_district_code', 'sub_district_name')
                            ->pluck('sub_district_name', 'sub_district_code')
                            ->sort();
    }
}
