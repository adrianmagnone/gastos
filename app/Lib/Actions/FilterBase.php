<?php

namespace App\Lib\Actions;

use App\Helpers\DateHelper as MiDate;
class FilterBase
{
    protected $filtersKeys;

    function __construct()
    {
        $this->filtersKeys = $this->setFiltersKeys();
    }

    public function execute(&$query, $requestData)
    {
        $filterValues = [];

        if ($this->filtersKeys)
            {
                foreach ($this->filtersKeys as $field)
                {
                    $filterValues[$field] =  (isset($requestData[$field]))
                                                ? $requestData[$field]
                                                : 0;
                }
            }

        if ($this->filtersKeys && $filterValues)
        {
            foreach($this->filtersKeys as $field)
            {
                if ( array_key_exists($field, $filterValues) )
                {
                    if ($filterValues[$field])
                    {
                        $funcion = 'filtro' . ucfirst($field);
                        $this->$funcion($query, $filterValues[$field]);
                    }
                }
            }    
        }
    }

    protected function setFiltersKeys()
    {
        return [];
    }

    protected function filtroBetweenDate(&$query, $desde, $hasta, $field)
    {
        $desde = ($desde)
            ? MiDate::fromFormatTo('d/m/Y', $desde, 'Y-m-d')
            : "";
        $hasta = ($hasta)
            ? MiDate::fromFormatTo('d/m/Y', $hasta, 'Y-m-d')
            : "";

        $this->filtroBetween($query, $desde, $hasta, $field);
    }

    protected function filtroBetween(&$query, $desde, $hasta, $field)
    {
        if ($desde && $hasta)
        {
            $query->whereBetween($field, [$desde, $hasta]);
        }
        elseif ($desde)
        {
            $query->where($field, '>=', $desde);
        }
        elseif ($hasta)
        {
            $query->where($field, '<=', $hasta);
        }
    }

    protected function filtroBetweenRaw(&$query, $desde, $hasta, $field)
    {
        if ($desde && $hasta)
        {
            $query->whereRaw("{$field} BETWEEN ? AND ?", [$desde, $hasta]);
        }
        elseif ($desde)
        {
            $query->whereRaw("{$field} >= ?", [$desde]);
        }
        elseif ($hasta)
        {
            $query->whereRaw("{$field} <= ?", [$hasta]);
        }
    }
}