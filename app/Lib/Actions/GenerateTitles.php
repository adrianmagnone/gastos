<?php

namespace App\Lib\Actions;

trait GenerateTitles
{
    public function generateExportTitles($order, $filter)
    {
        $this->createTitles();

        $titulos = array();

        // FILTROS
        if (count($filter['custom']))
        {
            $customValues = $filter['custom'];

            if ($this->filterTittleSustitute && $customValues)
            {
                foreach ($this->filterTittleSustitute as $field => $confSustituye)
                {
                    if ( array_key_exists($field, $customValues) && $this->checkIfHaveValue($customValues[$field]))
                    {
                        if (is_callable($confSustituye) )
                        {
                            $titulos[] = $confSustituye($customValues[$field]);
                        }
                    }
                }
            }
        }

        // BUSQUEDA
        if (trim($filter['search']))
        {
            $titulos[] = "Que contenga el valor: {$filter['search']}";
        }

        // ORDEN
        $columnaOrden = $order['field'];
        if ( array_key_exists($columnaOrden, $this->ordenTittleSustitute) )
        {
            $columnaOrden = $this->ordenTittleSustitute[$columnaOrden];
        }
        $direccion = ($order['dir'] == 'desc') ? ' En forma descendente' : '';

        $titulos[] = "Ordenado por {$columnaOrden}.{$direccion}";

        return $titulos;
    }

    protected function checkIfHaveValue($data)
    {
        if (is_array($data))
        {
            $keys = array_keys($data);
            foreach ($keys as $clave)
            {
                if (! empty($data[$clave]))
                {
                    return true;
                }
            }
            return false;
        }
        if (is_object($data))
        {
            return true;
        }
        return (!empty($data));
    }

    protected function getSqlData($sql, $field)
    {
        $results = \Illuminate\Support\Facades\DB::select($sql);

        if ($results)
        {
            return $results[0]->$field;
        }
        return false;
    }
}
