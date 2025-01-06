<?php

namespace App\Lib\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Admin\Models\Auditoria;
use App\Helpers\DateHelper as MiDate;

class EditAction
{
    const INSERTANDO  = 1;
    const EDITANDO    = 2;
    const ELIMINANDO  = 3;
    const CONSULTANDO = 4;

    protected $updatedMessage;
    protected $deletedMessage = 'La acción de borrado se ha realizado exitosamente';
    protected $functionImages = null;
    protected $useCreateOwnInModel = false;
    protected $urlSave;
    protected $urlList;
    protected $urlDelete;
    protected $relationsOfModel = [];
    protected $currentAction;

    protected $editView;
    protected $deleteView;

    protected $model;
    protected string $modelName = '';
    protected $request;

    protected $jsonResponse = [];

    public function runForCreate($request = null)
    {
        $this->currentAction = self::INSERTANDO;
        if ($request)
            $this->request =& $request;

        $entidad = $this->_createModel();

        $data = $this->aditionalDataForEdit($entidad);
        $data['layout']    = 'layouts.form';
        $data['action']    = $this->currentAction;
        $data['entity']    = $entidad;
        $data['saveUrl']   = $this->urlSave;        
        $data['returnUrl'] = $this->urlList;
        $data['pageTittle']= 'Alta de ' . $this->readModelName($entidad);

        return view($this->editView, $data);
    }

    public function runForEdit($id)
    {
        $this->currentAction = self::EDITANDO;
        $entidad = $this->model::findOrFail($id);

        $this->validateMyUpdate($entidad);

        $data = $this->aditionalDataForEdit($entidad);
        $data['layout']    = 'layouts.form';
        $data['action']    = $this->currentAction;
        $data['entity']    = $entidad;
        $data['saveUrl']   = $this->urlSave;        
        $data['returnUrl'] = $this->urlList;
        $data['pageTittle']= 'Editar ' . $this->readModelName($entidad);

        return view($this->editView, $data);
    }

    public function runForDelete($id)
    {
        $this->currentAction = self::ELIMINANDO;
        $entidad = $this->model::findOrFail($id);

        $this->validateMyDelete($entidad);

        $data = $this->aditionalDataForEdit($entidad);
        $data['layout']    = 'layouts.form';
        $data['action']    = $this->currentAction;
        $data['entity']    = $entidad;
        $data['saveUrl']   = $this->urlDelete;        
        $data['returnUrl'] = $this->urlList;
        $data['pageTittle']= 'Eliminar ' . $this->readModelName($entidad);

        return view($this->deleteView, $data);
    }

    public function runForView($id)
    {
        $this->currentAction = self::CONSULTANDO;
        $entidad = $this->model::findOrFail($id);

        $data = $this->aditionalDataForEdit($entidad);
        $data['layout']    = 'layouts.noform';
        $data['action']    = $this->currentAction;
        $data['entity']    = $entidad;
        $data['returnUrl'] = $this->urlList;
        $data['pageTittle']= 'Consultar ' . $this->readModelName($entidad);

        return view($this->editView, $data);
    }

    protected function readModelName(&$entidad)
    {
        if ($this->modelName)
            return $this->modelName;

        return \ltrim(\preg_replace('/[A-Z]/', ' $0', class_basename($entidad)));
    }

    public function runForSave($request)
    {
        $this->request =& $request;

        $entidad = false;
        $id = $this->request->input('id', false);

        if (!$id)
        {
            $this->currentAction = self::INSERTANDO;

            $newData = $this->prepareForValidation();

            if (\is_array($newData))
                $this->request->merge($newData);

            $validated = $this->request->validate($this->rules());

            $record = $this->getRecord();
            $record['user_id'] = Auth::id();

            \DB::beginTransaction();

            try
            {
                if ($this->useCreateOwnInModel)
                    $entidad = $this->model::createOwn($record);
                else
                    $entidad = $this->model::create($record);
             
                $this->completeUpdate($entidad, $this->request);

                $this->saveAudit($entidad);

                \DB::commit();
            }
            catch(\Throwable $th)
            {
                \DB::rollback();

                Log::error($th->getMessage());
                
                throw new \Exception("Ocurrio un error al guardar los datos.");
            }
        }
        else
        {
            $entidad = $this->update($id);
        }

        return $this->endUpdate($entidad);
    }

    public function runForSaveDelete($request)
    {
        $this->currentAction = self::ELIMINANDO;

        $this->request =& $request;

        $id = $this->request->input('id', false);

        $entidad = $this->model::findOrFail($id);

        $this->validateMyDelete($entidad);

        \DB::beginTransaction();

        try
        {
            if (\method_exists($this, 'deleteRecord'))
                $this->deleteRecord($entidad);
            else
                $entidad->delete();

            $this->completeDelete($entidad, $this->request);

            $this->saveAudit($entidad);

            \DB::commit();
        }
        catch (\Throwable $th)
        {
            \DB::rollback();

            Log::error($th->getMessage());
                
            throw new \Exception("Ocurrio un error al guardar los datos.");
        }

        return $this->endDelete($entidad);
    }

    protected function _createModel()
    {
        return new $this->model;
    }

    protected function aditionalDataForEdit(&$entidad = null)
    {
        return [];
    }

    protected function prepareForValidation()
    {
        return false;
    }

    protected function validateMyUpdate(&$entidad = null)
    {
        if (\method_exists($entidad, 'sePuedeEditar'))
        {
            if (! $entidad->sePuedeEditar())
            {
                throw new \App\Exceptions\InvalidUpdateException($entidad->mensajeValidacion);
            }
        }
    }

    protected function validateMyDelete(&$entidad = null)
    {
        if (\method_exists($entidad, 'sePuedeEliminar'))
        {
            if (! $entidad->sePuedeEliminar())
            {
                throw new \App\Exceptions\InvalidDeleteException($entidad->mensajeValidacion);
            }
        }
    }

    protected function endUpdate(&$entidad)
    {
        $this->request->session()->flash('update_message', $this->updatedMessage);
        if ($this->urlList)
            return redirect($this->urlList);

        return response()->json($this->jsonResponse);
    }

    protected function endDelete(&$entidad)
    {
        $this->request->session()->flash('update_message', $this->deletedMessage);
        return redirect($this->urlList);
    }

    protected function update($id)
    {
        $this->currentAction = self::EDITANDO;

        $entidad = $this->model::findOrFail($id);

        $this->validateMyUpdate($entidad);

        $newData = $this->prepareForValidation();

        if (\is_array($newData))
            $this->request->merge($newData);

        $validated = $this->request->validate($this->rules());

        $record = $this->getRecord();

        \DB::beginTransaction();

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

            $this->saveAudit($entidad);

            \DB::commit();
        }
        catch (\Throwable $th)
        {
            \DB::rollback();

            Log::error($th->getMessage());
                
            throw new \Exception("Ocurrio un error al guardar los datos.");
        }

        return $entidad;
    }

    protected function completeUpdate(&$entidad, &$request)
    {
        return false;
    }

    protected function completeDelete(&$entidad, &$request)
    {
        return false;
    }

    protected function saveAudit(&$entidad)
    {
        // $dataAudit = [
        //     'user_id'       => Auth::id(),
        //     'fecha'         => MiDate::todayWithTime(),
        //     'identificador' => $entidad->id,
        //     'modelo'        => get_class($entidad),
        //     'accion'        => $this->currentAction,
        //     'url'           => $this->request->url()
        // ];

        // $movAuditoria = Auditoria::create($dataAudit);

        // $cambios = $entidad->getChanges();
        // TODO Guardar el detalle de campos modificados.
    }

    protected function getObserverInstance()
    {
        return false;
    }

    protected function insertando()
    {
        return $this->currentAction == self::INSERTANDO;
    }

    protected function editando()
    {
        return $this->currentAction == self::EDITANDO;
    }

    protected function eliminando()
    {
        return $this->currentAction == self::ELIMINANDO;
    }

    protected function consultando()
    {
        return $this->currentAction == self::CONSULTANDO;
    }

    public function __get(string $name): mixed
    {
        return $this->request->{$name};
    }

    public function toDecimal(string $name) : mixed
    {
        $value = $this->request->{$name};

        return ($value) ? \trim(\str_replace (',', '.', \str_replace('.', '', $value))) : null;
    }

    public function valueToDecimal(mixed $value) : mixed
    {
        return ($value) ? \trim(\str_replace (',', '.', \str_replace('.', '', $value))) : null;
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