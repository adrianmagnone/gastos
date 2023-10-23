<?php

namespace App\Lib\Actions;

use DB;
use App\Helpers\DateHelper as MiDate;

class EditAction
{
    const INSERTANDO = 1;
    const EDITANDO   = 2;
    const ELIMINANDO = 3;

    protected $updatedMessage;
    protected $functionImages = null;
    protected $useCreateOwnInModel = false;
    protected $urlSave;
    protected $urlList;
    protected $relationsOfModel = [];
    protected $currentAction;

    protected $editView;
    protected $deleteView;

    protected $model;
    protected $request;

    public function runForCreate()
    {
        $entidad = $this->_createModel();

        $data = [
            'entity'    => $entidad,
            'saveUrl'   => $this->urlSave,
            'returnUrl' => $this->urlList,
        ];
        return view($this->editView, array_merge($data, $this->aditionalDataForEdit($entidad)));
    }

    public function runForEdit($id)
    {
        $entidad = $this->model::findOrFail($id);

        $data = [
            'entity'  => $entidad,
            'saveUrl' => $this->urlSave,
            'returnUrl' => $this->urlList,
        ];

        return view($this->editView, array_merge($data, $this->aditionalDataForEdit($entidad)));
    }

    public function runForSave($request)
    {
        $this->request =& $request;

        $entidad = false;
        $id = $this->request->input('id', false);

        if (!$id)
        {
            $this->currentAction = self::INSERTANDO;

            $validated = $this->request->validate($this->rules());

            $record = $this->getRecord();

            DB::beginTransaction();

            try
            {
                if ($this->useCreateOwnInModel)
                    $entidad = $this->model::createOwn($record);
                else
                    $entidad = $this->model::create($record);
             
                $this->completeUpdate($entidad, $this->request);
                DB::commit();
            }
            catch(\Throwable $th)
            {
                DB::rollback();
                dd($th->getMessage());
            }
        }
        else
        {
            $entidad = $this->update($id);
        }

        return $this->endUpdate($entidad);
    }

    public function runForDelete(&$request, $id)
    {
        $this->currentAction = self::ELIMINANDO;

        $this->request =& $request;
    }

    protected function _createModel()
    {
        return new $this->model;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [];
    }

    protected function endUpdate($entidad)
    {
        $this->request->session()->flash('update_message', $this->updatedMessage);
        return redirect($this->urlList);
    }

    protected function update($id)
    {
        $this->currentAction = self::EDITANDO;

        $validated = $this->request->validate($this->rules());

        $record = $this->getRecord();

        $entidad = $this->model::findOrFail($id);

        DB::beginTransaction();

        try
        {
            $entidad->fill( $record );
            $entidad->save();

            $this->completeUpdate($entidad, $this->request);

            $observer = $this->getObserverInstance();

            if ($observer)
            {
                $observer->updated($entidad);
            }

            DB::commit();
        }
        catch (\Throwable $th)
        {
            DB::rollback();
            dd($th->getMessage());
        }

        return $entidad;
    }

    protected function completeUpdate(&$entidad, &$request)
    {
        return false;
    }

    protected function getObserverInstance()
    {
        return false;
    }

    public function __get(string $name): mixed
    {
        return $this->request->{$name};
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

    protected function getTableName() : string
    {
        $obj = new $this->model();

        return $obj->getTable();
    }
}