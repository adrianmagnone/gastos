<?php

namespace App\Lib\Actions;

use stdClass;

class SelectAction
{
    const SEARCH_ENTIRE_PHRASE = 1;
    const SEARCH_WORD_BY_WORD  = 2;

    protected $viewList;
    protected $fieldSustitute;
    protected $ordenTittleSustitute = [];
    protected $filterTittleSustitute = [];
    protected $searchFields;
    protected $customFilterFields;
    protected $aditionalData;
    protected $aditionalOrder;

    protected $typeSearch = self::SEARCH_WORD_BY_WORD;

    protected $builderFilter;

    protected $model;
    protected $idField = 'id';
    protected $request;
    // Almacenamos todos los datos que vienen en $request
    protected $requestData;
    protected $filterClass = '';
    protected $myFilter;

    public $queryData;
    public $countData;
    public $exportTittle = '';

    protected $existFunctionSelectionFilter;
    protected $existFunctionCreateRecord;

    function __construct($model)
    {
        $this->model = new $model();

        $this->fieldSustitute  = $this->setFieldSustitute();
        $this->searchFields    = $this->setSearchFields();
        $this->customFilterFields = $this->setCustomFilters();
        $this->aditionalOrder  = $this->setAditionalOrderFields();
        $this->aditionalData   = $this->setAditionalData();
        $this->filterClass     = $this->setFilterClass();

        $this->existFunctionSelectionFilter = method_exists($this, 'setSelectionFilter');
        $this->existFunctionCreateRecord = method_exists($this, 'createRecord');
    }

    public function requestKey()
    {
        return '';
    }

    public function setSearchByPhrase()
    {
        $this->typeSearch = self::SEARCH_ENTIRE_PHRASE;
    }

    public function setSearchByWord()
    {
        $this->typeSearch = self::SEARCH_WORD_BY_WORD;
    }

    protected function setFieldSustitute()
    {
        return [];
    }

    protected function setSearchFields()
    {
        return [];
    }

    protected function setAditionalOrderFields()
    {
        return [];
    }

    protected function setCustomFilters()
    {
        return [];
    }

    protected function setAditionalData()
    {
        return [];
    }

    protected function aditionalDataForList()
    {
        return [];
    }

    protected function setFilterClass()
    {
        return '';
    }

    protected function getQuery()
    {
        return $this->model->query();
    }

    public function viewList()
    {
        return view($this->viewList)->with($this->aditionalDataForList());
    }

    public function run(&$request, $idValue = null)
    {
        $this->request = &$request;
        if ($idValue !== null)
        {
            $this->runFromId($idValue);
            return $this->exportRecord();
        }
        else
        {
            $this->requestData = $this->request->all();

            // Guardamos los datos en la sesion
            session([$this->requestKey() => $this->requestData]);

            $this->runFromRequest();
            return $this->exportDataTable();
        }
    }

    public function runForExport(&$request)
    {
        set_time_limit(0);
        //ini_set('memory_limit', config('define.exportar.memoria_excel'));

        setcookie(
            'Pagos[downloadXlsToken]',
            $request->query('downloadXlsToken'),
            time()+60*60,                  // expires 1 hour
            "/pagos",              // your path
            $_SERVER["HTTP_HOST"], // your domain
            false,               // Use true over HTTPS
            false               // Set true for $AUTH_COOKIE_NAME
        );

        $this->requestData = session($this->requestKey());

        $options = $this->createListOptions();

        $applyOrder =  $this->orderLista($options->orden);

        $query = $this->getQuery();

        $this->filterQuery($query, $options->filtro);

        $this->countData = $query->count(); 

        foreach($applyOrder as $orderBy)      
        {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        $this->queryData = $query->get();

        $this->exportTittle = $this->generateExportTitles($options->orden, $options->filtro);

        $this->createFile();
    }

    public function exportDataTable()
    {
        if ($this->request)
        {
            $result = new stdClass();
            $result->draw = (int) $this->request->query('draw');
            $result->recordsTotal = (int)$this->countData;
            $result->recordsFiltered = (int)$this->countData;
            $result->data= [];

            foreach ($this->queryData as $datos)
            {
                if ($this->existFunctionCreateRecord)
                    $record = $this->createRecord($datos);
                else
                    $record = $datos;

                if(! property_exists($record, 'puedeEditar'))
                    $record->puedeEditar = 1;
                if(! property_exists($record, 'puedeEliminar'))
                    $record->puedeEliminar = 1;

                $result->data[] = $record;
            }
        }
        return json_encode($result);
    }

    public function exportRecord()
    {
        $datos = $this->queryData->first();
        if ($datos)
        {
            $record = (method_exists($this, 'createRecord'))
                        ? $this->createRecord($datos)
                        : $datos;            
            return json_encode($record);
        }
            
        return json_encode(['id' => '', 'descripcion' => '' ]);
    }

    protected function runFromId($idValue)
    {
        $query = $this->getQuery();

        $this->createIdFilter($query, $idValue);

        $this->queryData = $query->get();
    }

    protected function runFromRequest()
    {
        $options = $this->createListOptions();

        $applyOrder =  $this->orderLista($options->orden);

        $query = $this->getQuery();

        $this->filterQuery($query, $options->filtro);

        $this->countData = $query->count();

        foreach($applyOrder as $orderBy)      
        {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        
        $query->skip($options->desde_reg)->take($options->cant_pagina);

        // \Illuminate\Support\Facades\DB::enableQueryLog();

        $this->queryData = $query->get();

        // dd(\Illuminate\Support\Facades\DB::getQueryLog());
    }

    protected function createListOptions()
    {
        $options = new stdClass();

        if ($this->requestData)
        {
            $options->cant_pagina = $this->requestData['length'];
            $options->desde_reg   = (int)$this->requestData['start'];

            $columns = $this->requestData['columns'];
            $order   = $this->requestData['order'];
            $search  = $this->requestData['search'];

            $options->orden = [
                'field' => $columns[$order[0]['column']]['name'],
                'dir'   => $order[0]['dir']
            ];
            $options->filtro = [
                'search' => $search['value'],
                'custom' => [],
            ];

            if ($this->aditionalData)
            {
                foreach ($this->aditionalData as $field)
                {
                    $options->filtro['custom'][$field] =  (isset($this->requestData[$field]))
                                                                ? $this->requestData[$field]
                                                                : 0;
                }
            }
        }
        else
        {
            $options->cant_pagina = 10;
            $options->desde_reg   = 0;
            $options->orden       = ['field'  => 'id', 'dir' => 'ASC' ];
            $options->filtro      = ['search' => '', 'custom' => [], ];
        }

        return $options;
    }

    
    protected function orderLista($order)
    {
        $columnaOrden = $order['field'];
        if ( array_key_exists($columnaOrden, $this->fieldSustitute) )
        {
            $columnaOrden = $this->fieldSustitute[$columnaOrden];
        }

        $ordenacion = [];

        if (is_array($columnaOrden))
        {
            foreach ($columnaOrden as $col)
            {
                $ordenacion[] = [$col, $order['dir']];    
            }
        }
        else
        {
            $ordenacion[] = [$columnaOrden, $order['dir']];
        }
        
        foreach ($this->aditionalOrder as $individualAditionalOrder)
        {
            $ordenacion[] = [ $individualAditionalOrder['field'], $individualAditionalOrder['dir'] ];
        }

        return $ordenacion;
    }

    protected function filterQuery(&$query, $filterValues)
    {
        if ($this->existFunctionSelectionFilter)
        {
            $this->setSelectionFilter($query);
        }

        if ($filterValues['search'] && $this->searchFields)
        {
            $query->where(function (\Illuminate\Database\Eloquent\Builder $whereQuery) use ($filterValues){

                foreach($this->searchFields as $searchField)
                {
                    $whereQuery->orWhere($searchField, 'LIKE', "%{$filterValues['search']}%");
                }

            });
        }

        if ($this->filterClass)
        {
            $this->myFilter = new $this->filterClass();

            $this->myFilter->execute($query, $this->requestData);

            return;
        }

        if ($this->aditionalData && $filterValues['custom'])
        {
            foreach($this->aditionalData as $field)
            {
                if ( array_key_exists($field, $filterValues['custom']) )
                {
                    if ($filterValues['custom'][$field])
                    {
                        $funcion = 'filtro' . ucfirst($field);
                        $this->$funcion($query, $filterValues['custom'][$field]);
                    }
                }
            }    
        }
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

    protected function createIdFilter(&$query, $idValue)
    {
        $query->where('id', (int)$idValue);
    }
}
