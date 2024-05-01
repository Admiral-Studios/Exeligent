<?php

namespace App\Services;

use App\Enums\ExecutiveRegionEnum;
use App\Models\Company;
use App\Models\CompanyProperty;
use App\Models\CompanyPropertyValue;
use App\Models\Executive;
use App\Models\ExecutiveFilter;
use Illuminate\Support\Collection;

class ExecutiveSearchService
{
    public ?Collection $filter_properties = null;
    const PER_PAGE = 9;

    public function getProperties()
    {
        return collect(array_map(function ($property_name) {
            $this->getProperty($property_name);
        }, Executive::ALL_PROPERTIES));
    }

    public function getProperty($name)
    {
        $uc_name = ucfirst($name);
        $methodName = "getAll{$uc_name}";
        if (method_exists(self::class, $methodName)) {
            return (object)[
                'title' => $uc_name,
                'name' => $name,
                'values' => self::$methodName()
            ];
        }
    }

    public function getExecutives(array $request)
    {
        $query = $request['query'] ?? '';

        $filters = [];
        $this->filter_properties = null;
        foreach (Executive::ALL_PROPERTIES as $property) {
            if (isset($request[$property])) {
                $this->setFilterProperties($request[$property], $property);

                if (is_array($request[$property])) {
                    foreach ($request[$property] as $item)
                        $filters[] = "{$property}:\"{$item}\"";
                }
            }
        }

        $regions = ExecutiveRegionEnum::cases();

        $withOptions = [];

        if (count($filters) > 0)
            $withOptions['filters'] = implode(' AND ', $filters);

        if (isset($request['region'])) {
            $region_str = $regions[array_search($request['region'], array_column($regions, "name"))]->value ?? null;
            if ($region_str) {
                $withOptions['similarQuery'] = "address:'{$region_str}'";
            }
        }

        $query = Executive::search($query)->with($withOptions);

        return $query->paginate(self::PER_PAGE);
    }


    public function getFilteredExecutives()
    {
        $filters = request()->all();

        if (count($filters) < 1) {
            return null;
        }

        foreach ($filters as $key => $value) {
            if (in_array($key, Executive::ALL_PROPERTIES)) {
                $filters[$key] = json_decode($value);
            }
        }

        return $this->getExecutives($filters);
    }

    private function setFilterProperties($values, $property_name)
    {
        $temp_data = $this->filter_properties ? $this->filter_properties->toArray() : [];
        $temp_data[$property_name] = (object) [
            'property' => $property_name,
            'property_title' => ucfirst($property_name),
            'values_in_string' => implode(', ', $values),
            'values_data_in_string' => implode(',', $values),
        ];

        $this->filter_properties = collect($temp_data);
    }





    public static function getAllIndustries()
    {
        $output = [];
        $industries = Executive::select('industries')
            ->whereNotNull('industries')
            ->distinct()
            ->pluck('industries')
            ->toArray();

        foreach ($industries as $industry) {
            if (is_array($industry))
                foreach ($industry as $value)
                    if (!in_array($value, $output))
                        $output[] = $value;
        }

        return $output;
    }

    public static function getAllFunctions()
    {
        $output = [];
        $functions = Executive::select('functions')
            ->whereNotNull('functions')
            ->distinct()
            ->pluck('functions')
            ->toArray();

        foreach ($functions as $function) {
            if (is_array($function))
                foreach ($function as $value)
                    if (!in_array($value, $output))
                        $output[] = $value;
        }

        return $output;
    }

    public static function getAllSpecialties()
    {
        $output = [];
        $specialties = Executive::select('specialties')
            ->whereNotNull('specialties')
            ->distinct()
            ->pluck('specialties')
            ->toArray();

        foreach ($specialties as $speciality) {
            if (is_array($speciality))
                foreach ($speciality as $value)
                    if (!in_array($value, $output))
                        $output[] = $value;
        }

        return $output;
    }

    public static function getAllCapabilities()
    {
        $output = [];
        $capabilities = Executive::select('capabilities')
            ->whereNotNull('capabilities')
            ->distinct()
            ->pluck('capabilities')
            ->toArray();

        foreach ($capabilities as $capability) {
            if (is_array($capability))
                foreach ($capability as $value)
                    if (!in_array($value, $output))
                        $output[] = $value;
        }

        return $output;
    }

    public function getFilters()
    {
        return ExecutiveFilter::active()->orderBy('pos')->get();
    }

    public function getFilteredPropertyValues(string $name): string
    {
        return \request()->input($name, '[]');
    }

}
