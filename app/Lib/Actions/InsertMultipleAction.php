<?php

namespace App\Lib\Actions;

use DB;
use App\Helpers\DateHelper as MiDate;

class InsertMultipleAction extends EditAction
{
    public function runForSave($request)
    {
        $this->request =& $request;

        $resultado = false;

        $this->currentAction = self::INSERTANDO;

        $newData = $this->prepareForValidation();

        if (\is_array($newData))
            $this->request->merge($newData);

        $validated = $this->request->validate($this->rules());

        $records = $this->getRecords();

        DB::beginTransaction();

        try
        {
            $tabla = $this->getTableName();

            $resultado = DB::table($tabla)->insert($records);
            
            $this->completeUpdate($resultado, $this->request);
            DB::commit();
        }
        catch(\Throwable $th)
        {
            DB::rollback();
            dd($th->getMessage());
        }

        return $this->endUpdate($resultado);
    }

    public function runSaveOneByOne($request)
    {
        $this->request =& $request;

        $resultado = false;

        $this->currentAction = self::INSERTANDO;

        $newData = $this->prepareForValidation();

        if (\is_array($newData))
            $this->request->merge($newData);

        $validated = $this->request->validate($this->rules());

        $records = $this->getRecords();

        DB::beginTransaction();

        try
        {
            foreach ($records as $record)
            {
                if ($this->useCreateOwnInModel)
                    $entidad = $this->model::createOwn($record);
                else
                    $entidad = $this->model::create($record);
         
                $this->completeUpdate($entidad, $this->request);    
            } 

            DB::commit();
        }
        catch(\Throwable $th)
        {
            DB::rollback();
            dd($th->getMessage());
        }

        return $this->endUpdate($resultado);
    }
}