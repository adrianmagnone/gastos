<?php

namespace App\Lib\Actions;

use DB;
use App\Helpers\DateHelper as MiDate;

class ImportFileAction
{
    protected $updatedMessage;
    protected $urlImport;
    protected $urlSave;
    protected $urlList;
    protected $skipRows;

    protected $loadView;
    protected $editView;

    protected $model;
    protected $data;
    protected $request;

    protected $cantidad;
    protected $importeNeto;
    protected $importeTotal;

    public function runImport($request = null)
    {
        if ($request)
            $this->request =& $request;

        //$entidad = $this->_createModel();

        $data = $this->aditionalDataForLoad();
        //$data['entity']  = $entidad;
        $data['formFile']  = true;
        $data['saveUrl']   = $this->urlImport;        
        $data['returnUrl'] = $this->urlList;

        return view($this->loadView, $data);
    }

    public function runLoadFile($request)
    {
        //set_time_limit(0);
        //ini_set('memory_limit', config('define.exportar.memoria_excel'));

        $this->request =& $request;

        $validated = $this->request->validate($this->rulesFile());

        $file = $this->loadFile();

        if ($file)
        {
            $this->data = [];
            $this->cantidad = 0; 
            $this->importeNeto = 0; 
            $this->importeTotal = 0; 

            $this->readFile($file);
            $this->validateFile($file);
            $this->processData($this->skipRows);

            $data = $this->aditionalDataForEdit($entidad);
            $data['data']      = $this->data;
            $data['saveUrl']   = $this->urlSave;        
            $data['returnUrl'] = $this->urlList;

            return view($this->editView, $data);
        }
    }

    public function runForSave($request)
    {
        $this->request =& $request;

        $resultado = false;

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

        $newData = $this->prepareForValidation();

        if (\is_array($newData))
            $this->request->merge($newData);

        $validated = $this->request->validate($this->rules());

        $records = $this->getRecords();

        $resultado = $this->executeSaveOneByOne($records);

        return $this->endUpdate($resultado);
    }

    protected function executeSaveOneByOne(&$records)
    {
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
            return true;
        }
        catch(\Throwable $th)
        {
            DB::rollback();

            \Illuminate\Support\Facades\Log::error($th->getMessage());
                
            throw new \Exception("Ocurrio un error al guardar los datos.");
        }
    }

    protected function _createModel()
    {
        return new $this->model;
    }

    protected function completeUpdate(&$entidad, &$request)
    {
        return false;
    }

    protected function loadFile()
    {
        return false;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [];
    }

    public function validateFile($file)
    {
        return true;
    }

    protected function endUpdate($entidad)
    {
        $this->request->session()->flash('update_message', $this->updatedMessage);
        return redirect($this->urlList);
    }
    
    public function rulesFile(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }

    protected function getRecords() : array
    {
        return [];
    }

    protected function prepareForValidation()
    {
        return false;
    }

    public function __get(string $name): mixed
    {
        return $this->request->{$name};
    }

    protected function getTableName() : string
    {
        $obj = new $this->model();

        return $obj->getTable();
    }

    public function intOrNull(string $name) : mixed
    {
        $value = $this->request->{$name};

        return ($value) ? (int)$value : null;
    }

    public function valueOrNull(string $name) : mixed
    {
        $value = $this->request->{$name};

        return ($value) ? $value : null;
    }

    public function valueOrZero(string $name) : mixed
    {
        $value = $this->request->{$name};

        return ($value) ? $value : 0;
    }

    public function onOff(string $name) : mixed
    {
        $value = $this->request->{$name};

        return ($value == 'on') ? 1 : 0;
    }

    public function dateOrNull(string $name) : mixed
    {
        $value = $this->request->{$name};
        
        return ($value)
                ? MiDate::fromFormatTo('d/m/Y', $value, 'Y-m-d')
                : null;
    }
}