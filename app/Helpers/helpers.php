<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists('arrayValueRecursive')) {
    function arrayValueRecursive($key, array $arr)
    {
        $val = array();
        array_walk_recursive($arr, function ($v, $k) use ($key, &$val) {
            if ($k == $key) array_push($val, $v);
        });

        return count($val) > 1 ? $val : array_pop($val);
    }
}

if (!function_exists('childrenMenuActive')) {
    function childrenMenuActive($routeName)
    {
        return str_replace(['.index', '.create', '.edit', '.budgets'], '', $routeName);
    }
}

if (!function_exists('mainSidebarRoute')) {
    function mainSidebarRoute($items)
    {
        $permissions = $items['permissions'];

        foreach ($permissions as $key => $val)
            if ( Auth::user()->can($key) )
                return route($val);
    }
}

if (!function_exists('unSLug')) {
    function unSLug($slug)
    {
        return Str::title(str_replace('-', ' ', $slug));
    }
}

if (!function_exists('limitText')) {
    function limitText($text, $length = 150)
    {
        $text = Str::limit(strip_tags(html_entity_decode($text)), $length, '...');

        return $text;
    }
}

if (!function_exists('phoneNumberID')) {
    function phoneNumberID($number)
    {
        return preg_replace('/^0|[^a-zA-Z0-9+]+/', '62', $number);
    }
}

if (!function_exists('phoneNumberShow')) {
    function phoneNumberShow($number) {
        if (substr($number, 0, 2) === "62") {
            $number = "0" . substr($number, 2);
        }
        $chunks = str_split($number, 4);
        return implode('-', $chunks);
    }
}

if (!function_exists('numericOnly')) {
    function numericOnly($string): int
    {
        $number = preg_replace("/[^0-9\.]/", '', $string);

        return $number ?: 0;
    }
}

if (!function_exists('currency')) {
    function currency($value, $en = false)
    {
        return $en ? number_format($value, 0, '.', ',') : number_format($value, 0, ',', '.');
    }
}

if (!function_exists('dateFormatLocale')) {
    function dateFormatLocale(Carbon $value, $format): string
    {
        return $value->locale('id')->translatedFormat($format);
    }
}
